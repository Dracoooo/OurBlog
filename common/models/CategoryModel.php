<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $cat_id
 * @property string $cat_name
 *
 * @property PostsModel[] $posts
 */
class CategoryModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'required'],
            [['cat_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'Cat Name',
        ];
    }

    /**
     * 得到分类对应的文章（一般用不上）
     * @return \common\models\PostsModel
     */
    public function getPosts()
    {
        return $this->hasMany(PostsModel::className(), ['cat_id' => 'cat_id']);
    }


    /**
     * 得到该分类下所有文章
     * @return array
     */
    public function getAllPosts(){
        return $this->posts;
    }

    /**
     * 得到该分类下分页对应的文章
     * @param $pageIndex 第几页
     * @param $amountPerPage 每页显示的数量
     * @return array 文章数组
     */
    public function getPostsByPageIndex($pageIndex,$amountPerPage){
        return PostsModel::find()->where(['cat_id'=>$this->cat_id])->offset(($pageIndex-1)*$pageIndex)->limit($amountPerPage)->all();
    }
}
