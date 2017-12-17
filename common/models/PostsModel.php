<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $cat_id
 * @property string $post_title
 * @property string $post_content
 * @property integer $post_views
 * @property integer $post_recommend
 * @property string $post_create_time
 * @property string $post_update_time
 *
 * @property Comments[] $comments
 * @property Category $cat
 * @property User $user
 */
class PostsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cat_id', 'post_views', 'post_recommend'], 'integer'],
            [['post_content'], 'string'],
            [['post_create_time', 'post_update_time'], 'safe'],
            [['post_title'], 'string', 'max' => 45],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'cat_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'cat_id' => 'Cat ID',
            'post_title' => 'Post Title',
            'post_content' => 'Post Content',
            'post_views' => 'Post Views',
            'post_recommend' => 'Post Recommend',
            'post_create_time' => 'Post Create Time',
            'post_update_time' => 'Post Update Time',
        ];
    }

    /**
     * 得到该文章所对应的评论信息
     * @return \common\models\CommentsModel
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'post_id']);
    }

    /**
     * 得到该文章所对应的分类信息
     * @return \common\models\CategoryModel
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['cat_id' => 'cat_id']);
    }

    /**
     * 得到该文章所对应的用户
     * @return \common\models\User
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /**
     * 得到分页对应的所有文章
     * @param $pageIndex 第几页
     * @param $amountPerPage 每页显示的数量
     * @return array 文章数组
     */
    public static function getPostsByPageIndex($pageIndex,$amountPerPage){
        //TODO：待写
        return array(new PostsModel());
    }

    /**
     * 得到该文章下所有评论
     * @return array
     */
    public function getAllComments(){
        //TODO：待写
        return array(new CommentsModel());
    }

    /**
     * 得到文章下评论分页对应的评论
     * @param $pageIndex 第几页
     * @param $amountPerPage 每页显示的数量
     * @return array 评论数组
     */
    public function getCommentsByPageIndex($pageIndex,$amountPerPage){
        //TODO：待写
        return array(new CommentsModel());
    }

    /**
     * 筛选指定分类的所有文章
     * @param $cat_id 分类ID
     * @return array 文章数组
     */
    public function getPostsByCatId($cat_id){
        return array(new PostsModel());
    }

}
