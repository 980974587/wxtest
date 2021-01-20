<?php

include_once('Util.php');
//access_token":"41_fo9U3ZHFoch5ccf0UxVPSrsko34jICDkG7UZwx0GtT8EYiTq3fRD27URwV6GDV-EkafE67ozuJrQBnLk_bFOtziMh-X9Ui4AE_YJQkfRT3U"
//expires_in:7200
//refresh_token:"41_v3_dXXPn3U1qQ5RgM5bUkvn32qR_4lQ0Ch6VZqf4FlkNQ-1nk5MypwaUxVC7HOzCIVSf4TRR-M1_4oKoVTpPQ4ZJ-vJ9IfMEEFWqG4CPJ8Y"
//openid:"oXmle1mpYCpVWPPVzytQ0H9NGiIc"


$appid='wx3f6c84918123741f';
$secret='9eebefa92a78d8bd47cbb4fed8368bf4';
//回调得到openid
$code=$_GET['code'];
$url='https://api.weixin.qq.com/sns/oauth2/access_token?';
$urlParam=[
    'appid'=>$appid,
    'secret'=>$secret,
    'code'=>$code,
    'grant_type'=>'authorization_code'
];
$curlOpts=[
    // 'CURLOPT_POST'=>true,
    CURLOPT_URL=>$url.http_build_query($urlParam),
    CURLOPT_HTTPHEADER=>['Content-Type:application/json'],
    CURLOPT_RETURNTRANSFER=>true
];
$ch=curl_init();
curl_setopt_array($ch,$curlOpts);
$returnJson=curl_exec($ch);
$returnJson=json_decode($returnJson,true);
if(empty($returnJson)||isset($returnJson['errcode'])){
    echo "获取临时令牌(与openid)错误:".$returnJson['errcode'].",".$returnJson['errmsg'];
}
$openid=$returnJson['openid'];

//获取accessToken
$accessToken=Util::getUniqueInstance()->getToken();

//用token和openid获取关注情况
$url="https://api.weixin.qq.com/cgi-bin/user/info?";
$urlParam=[
    'access_token'=>$accessToken,
    'openid'=>$openid,
    'lang'=>'zh_CN'
];
curl_setopt($ch,CURLOPT_URL,$url.http_build_query($urlParam));
$resultJson=curl_exec($ch);
$resultJson=json_decode($resultJson,true);
if(empty($resultJson)||isset($resultJson['errcode'])){
    echo "获取信息失败,请稍后重试";
}

curl_close($ch);
//已经关注转跳到首页
if($resultJson['subscribe']==1){
    var_dump($resultJson);
}else{
//没有关注转跳到二维码界面
}


