<?php
//接口验证,用于被微信服务器调用验证token


define('TOKEN','JR1Y1yn2fYVy2QQg0f2YyFh07XgFs2gx');
checkSignature();
//checkSignature();//这个函数运行一次配置成功就可以了
/**
 *验证token的函数
 */
function checkSignature(){
    //获取服务器的get请求的4个参数
    $signature=$_GET['signature'];
    $timeStamp=$_GET['timestamp'];
    $nonce=$_GET['nonce'];
    $echoStr=$_GET['echostr'];
    //定义一个数组 存储三个参数
    $tmpArr=array($nonce,$timeStamp,TOKEN);
    //数组的排序[进行字符串的排序]
    sort($tmpArr, SORT_STRING);
    //合并数组并加密成一个字符串
    $tmpStr = implode('',$tmpArr);
    $tmpStr = sha1( $tmpStr );
    //比较与signature是否一样，一样则返回echoStr
    if( $tmpStr == $signature ){
        echo $echoStr;
        return true;
    }else{
        return false;
    }
    
}