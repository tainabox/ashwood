<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property double $sum
 * @property string $status
 * @property int $customer_id
 *
 * @property Customer $customer
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum'], 'number'],
            [['status'], 'string'],
            [['customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['sum', 'status', 'customer_id'], 'validateFields', 'skipOnEmpty'=> false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum' => 'Сумма',
            'status' => 'Статус',
            'customer_id' => 'Имя пользователя',
        ];
    }

    public function validateFields()
    {
        if(empty($this->sum))
        {
            $errorMsg= 'Укажите сумму';
            $this->addError('sum',$errorMsg);
        }
        if(empty($this->status))
        {
            $errorMsg= 'Укажите статус';
            $this->addError('status',$errorMsg);
        }
        if(empty($this->customer_id))
        {
            $errorMsg= 'Укажите имя';
            $this->addError('customer_id',$errorMsg);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
