<?php

namespace app\models;

use Yii;
use yii\base\Model;


class SafaricomMpesaAPI extends Model{

    public $consumer_key;
    public $consumer_secret;
    public $token;
    //public $method;
    public $current_results;

    const BASE_URL = "";
    const REGISTER_URLS = "";
    

    public function __construct()
    {
        $api_credentials = (new ApiCredential())->findOne();
        $this->consumer_key = $api_credentials->consumer_key;
        $this->consumer_secret = $api_credentials->consumer_secret;
        $this->token = $api_credentials->token;
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
            $log->response_code = ''.$httpCode;
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

        $ch = curl_init(ConfigHelper::get('starlink_authentication_url'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/x-www-form-urlencoded']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                    'client_id' => ConfigHelper::get('starlink_client_id'),
                    'client_secret' => ConfigHelper::get('starlink_client_secret'),
                    'grant_type' => ConfigHelper::get('starlink_grant_type'),
                ]));

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                curl_close($ch);


        //$responded = json_decode($response, true);
        //file_put_contents('token.txt',$responded['access_token']);
        //$token = $responded['access_token'];


        $log = new StarlinkLogs();
        $log->date_time = date('Y-m-d H:i:s');
        $log->endpoint = $url;
        $log->status_code = ''.$httpCode;
        $log->comment = 'Generate Access Token';
        $log->errors = '';
        $log->warnings = '';
        $log->information = '';
        $log->is_valid = '';

        $log->save();

        if($httpCode == self::SUCCESS_CODE)
        {
        if($decoded = json_decode($response,true) )
        {



            $token = $decoded['access_token'];
            exec('/var/www/splynx/system/script/addon config-set --addon="splynx_starlink" --key="starlink_access_token" --value="' . $token . '"');
            return $token;
        }
        }
        //return empty array if non-json data

            return false;

    }

    //function to fetch actual results from api call
    public function extract_results($results)
    {
        return $results['content']['results'];

    }

    //declare url constants

    //define basic curl function

    //define required API methods
}