<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stk_push_request".
 *
 * @property int $id
 * @property int|null $business_short_code
 * @property string|null $timestamp
 * @property int|null $party_a
 * @property int|null $party_b
 * @property int|null $phone_number
 * @property float|null $amount
 * @property string|null $account_reference
 * @property string|null $transaction_description
 * @property string|null $merchant_request_id
 * @property string|null $checkout_request_id
 * @property int|null $response_code
 * @property string|null $response_description
 * @property string|null $customer_message
 */
class StkPushRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stk_push_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_short_code', 'party_a', 'party_b', 'phone_number', 'response_code'], 'integer'],
            [['timestamp'], 'safe'],
            [['amount'], 'number'],
            [['account_reference', 'transaction_description', 'merchant_request_id', 'checkout_request_id', 'response_description', 'customer_message'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_short_code' => Yii::t('app', 'Business Short Code'),
            'timestamp' => Yii::t('app', 'Timestamp'),
            'party_a' => Yii::t('app', 'Party A'),
            'party_b' => Yii::t('app', 'Party B'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'amount' => Yii::t('app', 'Amount'),
            'account_reference' => Yii::t('app', 'Account Reference'),
            'transaction_description' => Yii::t('app', 'Transaction Description'),
            'merchant_request_id' => Yii::t('app', 'Merchant Request ID'),
            'checkout_request_id' => Yii::t('app', 'Checkout Request ID'),
            'response_code' => Yii::t('app', 'Response Code'),
            'response_description' => Yii::t('app', 'Response Description'),
            'customer_message' => Yii::t('app', 'Customer Message'),
        ];
    }
}
