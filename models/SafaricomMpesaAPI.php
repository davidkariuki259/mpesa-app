<?php

namespace app\models;

use Yii;
use yii\base\Model;


class SafaricomMpesaAPI extends Model{

    public $consumer_key;
    public $consumer_secret;
    public $token;
    public $short_code;
    public $current_results;
    public $validation_url;
    public $callback_url;

    const BASE_URL = "https://api.safaricom.co.ke/";
    const REGISTER_URLS = "https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl";
    const GENERATE_TOKEN = "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

    const SUCCESS_RESPONSE = 0;
    

    public function __construct()
    {
        $api_credentials = (new ApiCredential())->findOne();
        $this->consumer_key = $api_credentials->consumer_key;
        $this->consumer_secret = $api_credentials->consumer_secret;
        $this->token = $api_credentials->token;
        $this->short_code = $api->short_code;
        $this->callback_url = $api->callback_url;
        $this->validation_url = $api->validation_url;
    }


    public function api_call($url, $method, $params=null)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => ''.self::BASE_URL.$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 0,
        //CURLOPT_HEADER => 1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER =>[
            'accept: application/json',
            'authorization: Bearer '.$this->token,
        ],
        ));

        if($params){	//if params array is provided
        //curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));	//append encoded parameters to body of request
        if($method == self::POST_METHOD || $method == self::PUT_METHOD)
        {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'accept: application/json',
                'authorization: Bearer '.$this->token,
                "content-type: application/json"
            ],);
        }
        else{
            curl_setopt($curl, CURLOPT_URL, ''.$this->base_url.$url.'?'.http_build_query($params));
        }

        }
        //curl_setopt($curl, CURLOPT_VERBOSE, 1);

        //print_r(curl_getinfo($curl));


        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);	//get size of header of response
        $response_head = substr($response, 0, $header_size);	//get response header
        $response_body = substr($response, $header_size);	//extract response body
        $url = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        //print_r(curl_getinfo($curl));
        //print_r($response);

        //$this->response_code = $http_status;    //set response code of request
        curl_close($curl);

        //print_r($response_body);

        //return json if json response

        if($decoded = json_decode($response,true) )
        {
            $log = new Logs();
            $log->date_time = date('Y-m-d H:i:s');
            $log->url = $url;
            $log->response_code = $decoded['ResponseCode'];
            $log->method = $method;
            $log->result = $response;

            $log->save();
            //print_r($log);
            $this->current_results = $decoded;
            return $decoded;
        }

        //record in logs and return false if non-json data

        $log = new Logs();
        $log->date_time = date('Y-m-d H:i:s');
        $log->url = $url;
        $log->response_code = ''.$httpCode;
        $log->method = $method;
        $log->result = "{'Empty':'Non-Json Data Returned'}";
        $log->save();
            

            return false;


    }

    public function generateToken()
    {
       // $data = array('client_id' => $client_id, 'client_secret' => $client_secret, 'grant_type' => 'client_credentials');


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::GENERATE_TOKEN);
        $credentials = base64_encode($this->consumer_key.':'.$this->consumer_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $curl_response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        


        //$responded = json_decode($response, true);
        //file_put_contents('token.txt',$responded['access_token']);
        //$token = $responded['access_token'];


        $log = new StarlinkLogs();
        $log->date_time = date('Y-m-d H:i:s');
        $log->url = self::GENERATE_TOKEN;
        $log->response_code = ''.$httpCode;
        $log->method = 'GET';
        $log->result = $curl_response;

        $log->save();

        $api_credentials = (new ApiCredential())->findOne();
        $api_credentials->token = json_decode($curl_response)->access_token;
        $api_credentials->save();

        return json_decode($curl_response)->access_token;

    }


    public function registerCallbackUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, static::REGISTER_URLS);

        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer ' . $this->token]);

        $postData = [
            'ShortCode' => $this->short_code,
            'ResponseType' => 'Completed',
            'ConfirmationURL' => $this->confirmation_url,
            'ValidationURL' => $this->validation_url,
        ];

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        $curl_response = curl_exec($curl);
        //$this->_response = $curl_response;
        $json_response = json_decode($curl_response, true);

        if($decoded = json_decode($curl_response,true) )
        {
            $log = new Logs();
            $log->date_time = date('Y-m-d H:i:s');
            $log->url = $url;
            $log->response_code = ''.$decoded['ResponseCode'];
            $log->method = $method;
            $log->result = $response;

            $log->save();
            //print_r($log);
            $this->current_results = $decoded;
            //return $decoded;
        }

        if (isset($json_response['ResponseDescription']) and $json_response['ResponseDescription'] == 'success') {
            //exec('/var/www/splynx/system/script/addon config-set --addon=splynx_addon_safaricom_mpesa --key=is_registered_urls --value=true');
            return true;
        }

        return false;
    }



    //declare url constants

    //define basic curl function

    //define required API methods
}