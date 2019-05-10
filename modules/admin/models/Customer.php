<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 *
 * @property Order[] $orders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'string', 'max' => 50],
            [['name', 'email', 'phone'], 'validateFields', 'skipOnEmpty'=> false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
        ];
    }

    public function validateFields()
    {
        if(empty($this->phone))
        {
            $errorMsg= 'Укажите телефон';
            $this->addError('phone',$errorMsg);
        }
        if(empty($this->email))
        {
            $errorMsg= 'Укажите email';
            $this->addError('email',$errorMsg);
        }
        if(empty($this->name))
        {
            $errorMsg= 'Укажите имя';
            $this->addError('name',$errorMsg);
        }
        if((strlen($this->phone)<7))
        {
            $errorMsg= 'Слишком мало цифр в номере телефона';
            $this->addError('phone',$errorMsg);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}
