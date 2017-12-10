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
 * @property CommentsModel[] $comments
 * @property CategoryModel $cat
 * @property UsersModel $user
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
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryModel::className(), 'targetAttribute' => ['cat_id' => 'cat_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersModel::className(), 'targetAttribute' => ['user_id' => 'user_id']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(CommentsModel::className(), ['post_id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(CategoryModel::className(), ['cat_id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UsersModel::className(), ['user_id' => 'user_id']);
    }
}
