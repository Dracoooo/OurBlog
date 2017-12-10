<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_info".
 *
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_sex
 * @property string $user_birthday
 * @property string $user_description
 * @property string $user_head_img
 *
 * @property UsersModel $user
 */
class UsersInfoModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_name'], 'required'],
            [['user_id'], 'integer'],
            [['user_name', 'user_birthday', 'user_head_img'], 'string', 'max' => 45],
            [['user_sex'], 'string', 'max' => 16],
            [['user_description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersModel::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_sex' => 'User Sex',
            'user_birthday' => 'User Birthday',
            'user_description' => 'User Description',
            'user_head_img' => 'User Head Img',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UsersModel::className(), ['user_id' => 'user_id']);
    }
}
