<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stk_push_result".
 *
 * @property int $id
 * @property string|null $merchant_request_id
 * @property string|null $checkout_request_id
 * @property int|null $status
 * @property int|null $result_code
 * @property string|null $result_description
 * @property float|null $amount
 * @property string|null $transaction_id
 * @property string|null $timestamp
 * @property int|null $phone_number
 */
class StkPushResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stk_push_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'result_code', 'phone_number'], 'integer'],
            [['amount'], 'number'],
            [['timestamp'], 'safe'],
            [['merchant_request_id', 'checkout_request_id', 'result_description', 'transaction_id'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'merchant_request_id' => Yii::t('app', 'Merchant Request ID'),
            'checkout_request_id' => Yii::t('app', 'Checkout Request ID'),
            'status' => Yii::t('app', 'Status'),
            'result_code' => Yii::t('app', 'Result Code'),
            'result_description' => Yii::t('app', 'Result Description'),
            'amount' => Yii::t('app', 'Amount'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'phone_number' => Yii::t('app', 'Phone Number'),
        ];
    }
}
