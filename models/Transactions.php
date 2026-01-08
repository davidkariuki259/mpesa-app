<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $transaction_id
 * @property string|null $transaction_time
 * @property int|null $success_status
 * @property float|null $amount
 * @property int|null $phone_number
 * @property string|null $first_name
 * @property string|null $second_name
 * @property string|null $last_name
 * @property float|null $account_balance
 * @property string|null $description
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_time'], 'safe'],
            [['success_status', 'phone_number'], 'integer'],
            [['amount', 'account_balance'], 'number'],
            [['type'], 'string', 'max' => 15],
            [['transaction_id', 'first_name', 'second_name', 'last_name', 'description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'transaction_time' => Yii::t('app', 'Transaction Time'),
            'success_status' => Yii::t('app', 'Success Status'),
            'amount' => Yii::t('app', 'Amount'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'first_name' => Yii::t('app', 'First Name'),
            'second_name' => Yii::t('app', 'Second Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'account_balance' => Yii::t('app', 'Account Balance'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TransactionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionsQuery(get_called_class());
    }
}
