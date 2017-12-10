<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $user_email
 * @property string $user_password
 * @property integer $user_authority
 * @property string $user_create_time
 *
 * @property CommentsModel[] $comments
 * @property FansModel[] $fans
 * @property FansModel[] $fans0
 * @property PostsModel[] $posts
 * @property UsersInfoModel $usersInfo
 */
class UsersModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_email', 'user_password'], 'required'],
            [['user_authority'], 'integer'],
            [['user_create_time'], 'safe'],
            [['user_email'], 'string', 'max' => 45],
            [['user_password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_email' => 'User Email',
            'user_password' => 'User Password',
            'user_authority' => 'User Authority',
            'user_create_time' => 'User Create Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(CommentsModel::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFans()
    {
        return $this->hasMany(FansModel::className(), ['fan_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFans0()
    {
        return $this->hasMany(FansModel::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(PostsModel::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersInfo()
    {
        return $this->hasOne(UsersInfoModel::className(), ['user_id' => 'user_id']);
    }
}
