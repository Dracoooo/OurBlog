<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()//对应属性的填写规则
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('common','This username has already been taken.')],
            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u','message'=>Yii::t('common','The username is made up of letter/character/number/"_",and cannot start with number/"_".')],
            ['username', 'string', 'min' => 2, 'max' => 16],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('common','This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['rePassword', 'required'],
            ['rePassword', 'string', 'min' => 6],
            ['rePassword','compare','compareAttribute'=>'password','message'=>Yii::t('common','The repassword is different from password.')],

            ['verifyCode','captcha'],
        ];
    }

    public function  attributeLabels()
    {
        return [
            'username'=>Yii::t('common','Username'),
            'password'=>Yii::t('common','Password'),
            'email'=>Yii::t('common','Email'),
            'rePassword'=>Yii::t('common','Repassword'),
            'verifyCode'=>Yii::t('common','Verifycode'),
            'rememberMe'=>Yii::t('common','remember me'),

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
