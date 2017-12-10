<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $comment_id
 * @property integer $user_id
 * @property integer $post_id
 * @property string $comment_content
 * @property string $comment_create_time
 *
 * @property PostsModel $post
 * @property UsersModel $user
 */
class CommentsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id'], 'required'],
            [['user_id', 'post_id'], 'integer'],
            [['comment_content'], 'string'],
            [['comment_create_time'], 'safe'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostsModel::className(), 'targetAttribute' => ['post_id' => 'post_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersModel::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'comment_content' => 'Comment Content',
            'comment_create_time' => 'Comment Create Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(PostsModel::className(), ['post_id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UsersModel::className(), ['user_id' => 'user_id']);
    }
}
