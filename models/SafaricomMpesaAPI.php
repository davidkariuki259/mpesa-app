<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SafaricomMpesaAPI extends Model{

    public $consumer_key;
    public $consumer_secret;
    public $token;

    public function __construct()
    {
        $api_credentials = (new ApiCredential())->findOne();
        $this->consumer_key = $api_credentials->consumer_key;
        $this->consumer_secret = $api_credentials->consumer_secret;
        $this->token = $api_credentials->token;
    }
    
    //declare url constants

    //define basic curl function

    //define required API methods
}