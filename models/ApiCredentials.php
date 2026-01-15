<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api_credentials".
 *
 * @property int $id
 * @property string|null $consumer_key
 * @property string|null $consumer_secret
 * @property string|null $token
 * @property string|null $last_updated
 */
class ApiCredentials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_credentials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_updated'], 'safe'],
            [['consumer_key', 'consumer_secret', 'token','confirmation_url','validation_url','passkey','stk_callback_url'], 'string'],
            [['short_code'],'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'consumer_key' => Yii::t('app', 'Consumer Key'),
            'consumer_secret' => Yii::t('app', 'Consumer Secret'),
            'token' => Yii::t('app', 'Token'),
            'last_updated' => Yii::t('app', 'Last Updated'),
            'short_code' => Yii::t('app','Short Code'),
            'confirmation_url' => Yii::t('app','Confirmation URL'),
            'validation_url' => Yii::t('app','Validation URL'),
            'passkey' => Yii::t('app','Encryption PassKey'),
            'stk_callback_url' => Yii::t('app','STK CallBack URL'),
        ];
    }
}
