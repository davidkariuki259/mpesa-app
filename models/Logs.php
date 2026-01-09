<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $url
 * @property string|null $result
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['result','date_time'], 'safe'],
            [['type'], 'string', 'max' => 10],
            [['url'], 'string'],
            [['method'],'string','max' => 10],
            [['response_code'],'integer']
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
            'url' => Yii::t('app', 'Url'),
            'result' => Yii::t('app', 'Result'),
            'date_time' => Yii::t('app','Date'),
            'method' => Yii::t('app','Method'),
            'response_code' => Yii::t('app','Response Code'),
        ];
    }
}
