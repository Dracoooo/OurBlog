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
//        echo "Hello,Draco";
        $m =  new models\UsersInfoModel();

        return $this->render('index');
    }

}