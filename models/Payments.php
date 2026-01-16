<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property string|null $transaction_id
 * @property string|null $transaction_time
 * @property int|null $business_short_code
 * @property string|null $bill_ref_number
 * @property string|null $invoice_number
 * @property string|null $third_party_transaction_id
 * @property float|null $amount
 * @property int|null $phone_number
 * @property string|null $first_name
 * @property string|null $second_name
 * @property string|null $last_name
 * @property float|null $account_balance
 * @property int|null $reversal_status
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_time'], 'safe'],
            [['business_short_code', 'phone_number', 'reversal_status'], 'integer'],
            [['amount', 'account_balance'], 'number'],
            [['transaction_id', 'bill_ref_number', 'invoice_number', 'third_party_transaction_id', 'first_name', 'second_name', 'last_name'], 'string'],
            [['transaction_id'],'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'transaction_time' => Yii::t('app', 'Transaction Time'),
            'business_short_code' => Yii::t('app', 'Business Short Code'),
            'bill_ref_number' => Yii::t('app', 'Bill Ref Number'),
            'invoice_number' => Yii::t('app', 'Invoice Number'),
            'third_party_transaction_id' => Yii::t('app', 'Third Party Transaction ID'),
            'amount' => Yii::t('app', 'Amount'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'first_name' => Yii::t('app', 'First Name'),
            'second_name' => Yii::t('app', 'Second Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'account_balance' => Yii::t('app', 'Account Balance'),
            'reversal_status' => Yii::t('app', 'Reversal Status'),
        ];
    }

    public function loadTransactionData(array $data)
    {
        if (!empty($data)) {
            $this->transaction_id = $data['TransID'];
            $this->transaction_time = $data['TransTime'];
            $this->business_short_code = $data['BusinessShortCode'];
            $this->bill_ref_number = $data['BillRefNumber'];
            $this->invoice_number = $data['InvoiceNumber'];
            $this->third_party_transaction_id = $data['ThirdPartyTransID'];
            $this->amount = floatval($data['TransAmount']);
            $this->phone_number = $data['MSISDN'];            
            $this->first_name = $data['FirstName'];
            $this->second_name = $data['MiddleName'];
            $this->last_name = $data['LastName'];
            $this->account_balance = (float)$data['OrgAccountBalance'];

        }
    }


}
