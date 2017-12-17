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
 * @property Posts $post
 * @property User $user
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
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'post_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
     * 得到该评论对应的文章
     * @return \common\models\PostsModel
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['post_id' => 'post_id']);
    }

    /**
     * 得到发表该评论的用户
     * @return \common\models\User
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
