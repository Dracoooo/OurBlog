<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fans".
 *
 * @property integer $user_id
 * @property integer $fan_id
 *
 * @property User $fan
 * @property User $user
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
            [['fan_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fan_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
     * 得到关注者的用户
     * @return \common\models\User
     */
    public function getFan()
    {
        return $this->hasOne(User::className(), ['id' => 'fan_id']);
    }

    /**
     * 得到被关注者的用户
     * @return \common\models\User
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
