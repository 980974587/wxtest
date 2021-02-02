<?php
require_once('Util.php');
/**
 * @desc 获取token和jsTicket
 */
class AccessToken
{
    private static $accessToken;
    private static $token_expires_in;
    private static $uniqueInstance;
    private static $jsApiTicket;
    private static $ticket_expires_in;

    //单例
    public static function getUniqueInstance()
    {
        if (is_null(self::$uniqueInstance)) {
            self::$uniqueInstance = new AccessToken();
        }
        if (self::$token_expires_in <= (time() - 300)) {
            self::getAccessToken();
        }
        if (self::$ticket_expires_in <= (time() - 300)) {
            self::getJsApiTicket();
        }
        return self::$uniqueInstance;
    }

    private function __construct()
    {
        self::getAccessToken();
        self::getJsApiTicket();
    }

    public function getToken()
    {
        return self::$accessToken;
    }
    public function getTicket()
    {
        return self::$jsApiTicket;
    }



    /**
     * @desc 向微信请求得到token
     */
    private static function getAccessToken()
    {
        $appid = Util::getConfig('config', 'appid');
        $secret = Util::getConfig('config', 'secret');
        //获取accessToken
        // $openid=$returnJson['access_token'];
        $urlParam = [
            'grant_type' => 'client_credential',
            'appid' => $appid,
            'secret' => $secret
        ];
        $url = Util::getConfig('config', 'globaleTokenUrl');
        $curlOpts = [
            // 'CURLOPT_POST'=>true,
            CURLOPT_URL => $url . http_build_query($urlParam),
            CURLOPT_HTTPHEADER => ['Content-Type:application/json'],
            CURLOPT_RETURNTRANSFER => true,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $curlOpts);
        $returnJson = curl_exec($ch);
        $returnJson = json_decode($returnJson, true);
        if (empty($returnJson) || isset($returnJson['errcode'])) {
            return false;
        }
        self::$accessToken = $returnJson['access_token'];
        self::$token_expires_in = $returnJson['expires_in'] + time();
    }

    public function refreshAccessToken()
    {
        self::getAccessToken();
    }

    /**
     * @desc 向微信请求得到JsApiTicket
     */
    private static function getJsApiTicket()
    {
        if (self::$token_expires_in <= (time() - 300)) {
            self::getAccessToken();
        }
        $urlParam = [
            'access_token' => self::$accessToken,
            'type' => 'jsapi',
        ];
        $url = Util::getConfig('config', 'globalTicketUrl');
        $curlOpts = [
            // 'CURLOPT_POST'=>true,
            CURLOPT_URL => $url . http_build_query($urlParam),
            CURLOPT_RETURNTRANSFER => true,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $curlOpts);
        $returnJson = curl_exec($ch);
        $returnJson = json_decode($returnJson, true);
        if (empty($returnJson) || $returnJson['errcode']!=0) {
            return false;
        }
        self::$jsApiTicket = $returnJson['ticket'];
        self::$ticket_expires_in = $returnJson['expires_in'] + time();
    }
}
