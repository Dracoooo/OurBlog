<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fans".
 *
 * @property integer $user_id
 * @property integer $fan_id
 *
 * @property UsersModel $fan
 * @property UsersModel $user
 */
class FansModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fan_id'], 'required'],
            [['user_id', 'fan_id'], 'integer'],
            [['fan_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersModel::className(), 'targetAttribute' => ['fan_id' => 'user_id']],
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
            'fan_id' => 'Fan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFan()
    {
        return $this->hasOne(UsersModel::className(), ['user_id' => 'fan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UsersModel::className(), ['user_id' => 'user_id']);
    }
}
