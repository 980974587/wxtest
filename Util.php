<?php

class Util{
    private static $accessToken;
    private static $expires_in;
    private static $uniqueInstance;

    private function __construct()
    {
        self::getAccessToken();
    }

    public static function getToken(){
        return self::$accessToken;
    }

    public static function getUniqueInstance()
    {
        if(is_null(self::$uniqueInstance)){
            self::$uniqueInstance=new Util();
        }
        if(self::$expires_in<=(time()-300)){
            self::getAccessToken();
        }
        return self::$uniqueInstance;
    }

    private static function getAccessToken(){
        $appid='wx3f6c84918123741f';
        $secret='9eebefa92a78d8bd47cbb4fed8368bf4';
        //获取accessToken
        // $openid=$returnJson['access_token'];
        $urlParam=[
            'grant_type'=>'client_credential',
            'appid'=>$appid,
            'secret'=>$secret
        ];
        $url='https://api.weixin.qq.com/cgi-bin/token?';
        $curlOpts=[
            // 'CURLOPT_POST'=>true,
            CURLOPT_URL=>$url.http_build_query($urlParam),
            CURLOPT_HTTPHEADER=>['Content-Type:application/json'],
            CURLOPT_RETURNTRANSFER=>true,
        ];
        $ch=curl_init();
        curl_setopt_array($ch,$curlOpts);
        $returnJson=curl_exec($ch);
        $returnJson=json_decode($returnJson,true);
        if(empty($returnJson)&&$returnJson['errcode']){
            return false;
        }
        self::$accessToken=$returnJson['access_token'];
        self::$expires_in=$returnJson['expires_in']+time();
    }
    
    public static function refreshAccessToken(){
        self::getAccessToken();
    }

}

