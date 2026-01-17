<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\SafaricomMpesaAPI;


class SendPushController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $getPhone = Yii::$app->request->get('phonenumber');
        $getAmount = Yii::$app->request->get('amount');

        if($getAmount && $getPhone)
        {
            $getPhone = '254'.$getPhone;



            $mpesa_api = new SafaricomMpesaAPI();
            $stk_request = $mpesa_api->stk($getAmount,$getPhone);

            //print_r($registration);

            return $this->render('index',['response' => $mpesa_api->_response]);
        }

        return $this->render('index',['response' => array()]);
    }

}
