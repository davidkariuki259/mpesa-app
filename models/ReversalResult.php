<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reversal_result".
 *
 * @property int $id
 * @property string|null $result_type
 * @property int|null $result_code
 * @property string|null $transaction_id
 * @property string|null $originator_conversation_id
 * @property string|null $conversation_id
 * @property float|null $account_balance
 * @property float|null $amount
 * @property string|null $completed_time
 * @property string|null $original_transaction_id
 * @property float|null $charge
 * @property string|null $credit_party_name
 * @property string|null $debit_party_name
 */
class ReversalResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reversal_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['result_code'], 'integer'],
            [['account_balance', 'amount', 'charge'], 'number'],
            [['completed_time'], 'safe'],
            [['result_type', 'transaction_id', 'originator_conversation_id', 'conversation_id', 'original_transaction_id', 'credit_party_name', 'debit_party_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'result_type' => Yii::t('app', 'Result Type'),
            'result_code' => Yii::t('app', 'Result Code'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'originator_conversation_id' => Yii::t('app', 'Originator Conversation ID'),
            'conversation_id' => Yii::t('app', 'Conversation ID'),
            'account_balance' => Yii::t('app', 'Account Balance'),
            'amount' => Yii::t('app', 'Amount'),
            'completed_time' => Yii::t('app', 'Completed Time'),
            'original_transaction_id' => Yii::t('app', 'Original Transaction ID'),
            'charge' => Yii::t('app', 'Charge'),
            'credit_party_name' => Yii::t('app', 'Credit Party Name'),
            'debit_party_name' => Yii::t('app', 'Debit Party Name'),
        ];
    }
}
