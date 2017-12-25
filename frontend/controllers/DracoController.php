<?php
/**
 * Created by PhpStorm.
 * User: Draco
 * Date: 12/10/2017
 * Time: 10:31 PM
 */

namespace frontend\controllers;

use yii\web\Controller;
use common\models;

class DracoController extends Controller{

    public function actionIndex(){
        echo '<pre>';
//        echo "Hello,Draco";
//        $m =  new models\UsersInfoModel();



//        通过文章id寻找文章
//        $post = models\PostsModel::findOne(['post_id'=>2]);
//        echo $post->post_content;
//        通过文章标题寻找文章
//        $post = models\PostsModel::findOne(['post_title'=>'今天天气真冷']);
//        echo $post->post_content;

//        搜索用户所有文章
//        $post = models\PostsModel::findAll(['user_id'=>2]);
//        echo print_r($post);

//        带限制数量的查找
//        $post = models\PostsModel::find()->where(['user_id'=>2])->limit(2)->offset(1)->all();
//        echo print_r($post);

//        添加新文章 (其他内容保存进数据库方法同这个)
//        $post = new models\PostsModel();
//        $post->user_id = 2;
//        $post->cat_id = 1;
//        $post->post_title = '写一篇试试';
//        $post->post_content = '厉害了现在是'.date("Y.m.d h:i:s").'创建的文章';
//        $post->save();   //更新数据库核心所在

//        删除某篇文章
//        models\PostsModel::findOne(['post_id'=>6])->delete();

//        修改某篇文章
//        $post = models\PostsModel::findOne(['post_id'=>3]);
//        $post->post_content='越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖越吃越胖';
//        $post->update();

//        试试分页（文章分页）（每页2条，看第1页）
//        $post = models\PostsModel::getPostsByPageIndex(1,2);
//        echo print_r($post);


//        得到某篇文章的评论
//        $post = models\PostsModel::findOne(['post_id'=>2]);
//        echo print_r($post->comments);
//        echo print_r($post->getAllComments());

//        得到某篇文章的评论的分页（每页2条，看第1页）
//        $post = models\PostsModel::findOne(['post_id'=>2]);
//        echo print_r($post->getCommentsByPageIndex(1,2));


//        获得一个分类下所有文章
//        $cat = models\CategoryModel::findOne(['cat_id'=>1]);
//        echo print_r($cat->posts);
//        echo print_r($cat->getAllPosts());

//        获得一个分类下文章的分页（每页2条，看第1页）
//        $cat = models\CategoryModel::findOne(['cat_id'=>1]);
//        echo print_r($cat->getPostsByPageIndex(1,2));


//        获得一个用户的粉丝数量
//        $user = models\User::findOne(['id'=>2]);
//        echo  $user->getFansAmount();

//        获得一个用户的粉丝用户
//        $user = models\User::findOne(['id'=>2]);
//        echo  '数量:'.count($user->getAllFansUser()).'<br>';
//        echo  print_r($user->getAllFansUser());


//        获得一个用户的关注数量
//        $user = models\User::findOne(['id'=>1]);
//        echo  $user->getIdolAmount();

//        获得一个用户的关注用户
//        $user = models\User::findOne(['id'=>1]);
//        echo  '数量:'.count($user->getAllIdolUser()).'<br>';
//        echo  print_r($user->getAllIdolUser());

//        获得用户发过的所有博文
//        $user = models\User::findOne(['id'=>1]);
//        echo  print_r($user->getAllPosts());

//        获得用户发过的所有博文分页（每页2条，看第1页）
//        $user = models\User::findOne(['id'=>2]);
//        echo  print_r($user->getPostsByPageIndex(1,2));


//        获得用户发过的所有评论
//        $user = models\User::findOne(['id'=>2]);
//        echo  print_r($user->getAllComments());

//        获得用户发过的所有评论分页（每页2条，看第1页）
//        $user = models\User::findOne(['id'=>1]);
//        echo  print_r($user->getCommentsByPageIndex(1,2));


//        获得所有关注用户所有文章
//        $user = models\User::findOne(['id'=>2]);
//        echo  print_r($user->getIdolPosts());

//       获得所有关注用户所有文章分页（每页2条，看第1页）
//        $user = models\User::findOne(['id'=>2]);
//        echo  print_r($user->getIdolPostsByPageIndex(1,2));


        echo '</pre>';

        //return $this->render('index');
    }

}