<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\SafaricomMpesaAPI;


class RegisterUrlsController extends Controller
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
        //Yii::$app->response->format = Response::FORMAT_JSON;
        $token_generation = new SafaricomMpesaAPI();
        $token_generation->generateToken();
        $mpesa_api = new SafaricomMpesaAPI();
        $registration = $mpesa_api->registerCallbackUrls();

        $this->getView()->title = Yii::t('app','Register URLs');

        return $this->render('index',['response' => $mpesa_api->_response]);
    }

}
