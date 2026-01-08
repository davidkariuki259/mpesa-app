<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reversal_request".
 *
 * @property int $id
 * @property string|null $initiator
 * @property string|null $transaction_id
 * @property float|null $amount
 * @property string|null $date_initiated
 * @property string|null $remarks
 * @property string|null $conversation_id
 * @property string|null $originator_conversation_id
 */
class ReversalRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reversal_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['date_initiated'], 'safe'],
            [['initiator', 'transaction_id', 'remarks', 'conversation_id', 'originator_conversation_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'initiator' => Yii::t('app', 'Initiator'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'amount' => Yii::t('app', 'Amount'),
            'date_initiated' => Yii::t('app', 'Date Initiated'),
            'remarks' => Yii::t('app', 'Remarks'),
            'conversation_id' => Yii::t('app', 'Conversation ID'),
            'originator_conversation_id' => Yii::t('app', 'Originator Conversation ID'),
        ];
    }
}
