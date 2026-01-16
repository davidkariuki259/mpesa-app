<?php

namespace app\controllers;

use Yii;

use app\models\Logs;
use app\models\Payments;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Transactions;
use app\models\SafaricomMpesaAPI;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\Controller;

class ProcessPaymentsController extends Controller
{
    /**
     * {@inheritdoc}
     */


    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionConfirmPayment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $postData = Yii::$app->request->post();
        $ip_address = Yii::$app->request->userIP;

        $payments = new Payments();
        $payments->loadTransactionData($postData);
        $payments->save();

        $log_entry = new Logs();
        $log_entry->type= 'incoming';
        $log_entry->url = $ip_address;
        $log_entry->result = $postData;
        $log_entry->date_time = date('Y-m-d H:i:s');
        $log_entry->method = 'POST';
        $log_entry->response_code = SafaricomMpesaAPI::SUCCESS_RESPONSE;

        $log_entry->save();

        return [
            'ResultCode' => 0,
            'ResultDesc' => Yii::t('app', 'Success'),
            //'ThirdPartyTransID' => 0,
        ];
    }

    public function actionValidatePayment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $postData = Yii::$app->request->post();
        $ip_address = Yii::$app->request->userIP;

        $log_entry = new Logs();
        $log_entry->type= 'incoming';
        $log_entry->url = $ip_address;
        $log_entry->result = $postData;
        $log_entry->date_time = date('Y-m-d H:i:s');
        $log_entry->method = 'POST';
        $log_entry->response_code = SafaricomMpesaAPI::SUCCESS_RESPONSE;

        $log_entry->save();

        return [
            'ResultCode' => 0,
            'ResultDesc' => Yii::t('app', 'Success'),
            //'ThirdPartyTransID' => 0,
        ];

    }

    public function actionProcessPush()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        //$postData = Yii::$app->request->post();
        $postData = file_get_contents('php://input');
        $new_data = json_decode($postData,true);
        $ip_address = Yii::$app->request->userIP;
        //$callback = array_key_exists($new_data['Body']['stkCallback']['CallbackMetadata']) ? $new_data['Body']['stkCallback']['CallbackMetadata'] : null;

        if(isset($new_data['ResultCode']) && $new_data['ResultCode'] === 0){

        $payments = new Payments();
        $payments->loadStkData($new_data);
        $payments->save();
        }

        $log_entry = new Logs();
        $log_entry->type= 'incoming';
        $log_entry->url = $ip_address;
        $log_entry->result = $postData;
        $log_entry->date_time = date('Y-m-d H:i:s');
        $log_entry->method = 'POST';
        $log_entry->response_code = SafaricomMpesaAPI::SUCCESS_RESPONSE;

        $log_entry->save();

        return [
            'ResultCode' => 0,
            'ResultDesc' => Yii::t('app', 'Success'),
            //'ThirdPartyTransID' => 0,
        ];
    }

}
