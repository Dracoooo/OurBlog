<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property integer $authority
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * 验证是否满足登陆权限
     * @param $authority 所需要的权限值
     * @return bool
     */
    public function validateAuthority($authority){
        return $this->authority >= $authority;
    }

    /**
     * 得到粉丝数量
     * @return int 粉丝数量
     */
    public function getFansAmount(){
        return count(FansModel::findAll(['user_id'=>$this->id]));
    }

    /**
     * 得到所有粉丝用户
     * @return array 用户数组
     */
    public function getAllFansUser(){
        $fans = FansModel::findAll(['user_id'=>$this->id]);
        $result = array();
        foreach ($fans as $value){
            $result[] = $value->fan;
        }
        return $result;
    }

    /**
     * 得到关注者数量
     * @return int 关注者数量
     */
    public function getIdolAmount(){
        return count(FansModel::findAll(['fan_id'=>$this->id]));
    }

    /**
     * 得到所有关注者用户
     * @return array 用户数组
     */
    public function getAllIdolUser(){
        $users = FansModel::findAll(['fan_id'=>$this->id]);
        $result = array();
        foreach ($users as $value){
            $result[] = $value->user;
        }
        return $result;
    }


    /**
     * 得到用户信息
     * @return UsersInfoModel
     */
    public function getUserInfo(){
        return UsersInfoModel::findOne(['user_id'=>$this->id]);
    }

    /**
     * 得到用户发表的所有博文
     * @return array 所有博文
     */
    public function getAllPosts(){
        return PostsModel::findAll(['user_id'=>$this->id]);
    }

    /**
     * 得到该分类下分页对应的文章
     * @param $pageIndex 第几页
     * @param $amountPerPage 每页显示的数量
     * @return array 文章数组
     */
    public function getPostsByPageIndex($pageIndex,$amountPerPage){
        return PostsModel::find()->where(['user_id'=>$this->id])->offset(($pageIndex-1)*$pageIndex)->limit($amountPerPage)->all();
    }


    /**
     * 得到用户发表的所有评论
     * @return array 所有评论
     */
    public function getAllComments(){
        return CommentsModel::findAll(['user_id'=>$this->id]);
    }

    /**
     * 得到文章下评论分页对应的评论
     * @param $pageIndex 第几页
     * @param $amountPerPage 每页显示的数量
     * @return array 评论数组
     */
    public function getCommentsByPageIndex($pageIndex,$amountPerPage){
        return CommentsModel::find()->where(['user_id'=>$this->id])->offset(($pageIndex-1)*$pageIndex)->limit($amountPerPage)->all();
    }

    /**
     * @return array 关注用户发表的文章数组（按最新时间排序）
     */
    public function getIdolPosts(){
        $idols_id_str = $this->getIdolsIdStr();    //得到关注用户id 的字符串，用于MySQL查询用
        return PostsModel::find()->where('user_id in('.$idols_id_str.')')->orderBy('post_create_time desc')->all();  //按照用户id 查询，按照最新发布时间排序
    }

    /**
     * 关注用户发表的文章数组分页（按最新时间排序）
     * @param $pageIndex 第几页
     * @param $amountPerPage 每页显示的数量
     * @return array|ActiveRecord[]
     */
    public function getIdolPostsByPageIndex($pageIndex,$amountPerPage){
        $idols_id_str = $this->getIdolsIdStr(); //得到关注用户id 的字符串，用于MySQL查询用
        return PostsModel::find()->where('user_id in('.$idols_id_str.')')->orderBy('post_create_time desc')->offset(($pageIndex-1)*$pageIndex)->limit($amountPerPage)->all();//按照用户id 查询，按照最新发布时间排序，带分页
    }

    /**
     * 得到关注用户id的字符串
     * @return string
     */
    private function getIdolsIdStr(){
        $idols = FansModel::findAll(['fan_id'=>$this->id]);   //寻找所有关注的用户
        $idols_id_str = '';   //声明字符串变量
        $amount = count($idols);  //得到关注用户数量
        for($i=0;$i<$amount;$i++){
            $idols_id_str .= $idols[$i]->user_id;  //得到用户id
            if($i==$amount-1){
                break;   //如果是最后一个id 则不需要添加逗号
            }
            $idols_id_str .= ',';   //添加逗号做分割
        }
        return $idols_id_str;  //返回字符串
    }

}
