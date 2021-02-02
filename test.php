<?php

// phpinfo();


// define('ROOT', __DIR__);
// include_once('AccessToken.php');
// include_once('Util.php');

// $token = AccessToken::getUniqueInstance()->getToken();
// echo $token.PHP_EOL;
// $ticket = AccessToken::getUniqueInstance()->getTicket();
// var_dump($ticket);



// $list=['abc'=>'http://abc.com'];
// $list=http_build_query($list);
// echo $list.PHP_EOL;
// echo urldecode($list);

function randomCard($hasLucky)
{
    //读取概率配置
    // $cardProb = \PhalApi\DI()->config->get('boc_zj_jnk_config.cardProb');
    $cardProb = ['yq' => 10, 'jk' => 22.5, 'aq' => 22.5, 'sy' => 22.5, 'cf' => 22.5];
    $cardTypeList = array_keys($cardProb);
    $cardNum = array_values($cardProb);

    //概率转为整数,并设置对应随机数范围
    $cardNum[0] = (int)100 * $cardNum[0];
    for ($i = 1; $i < count($cardProb); $i++) {
        $cardNum[$i] = $cardNum[$i - 1] + (int)($cardNum[$i] * 100);
    }

    if ($hasLucky) {
        $randomNum = random_int(1, 10000);
    } else {
        $randomNum = random_int($cardNum[0] + 1, 10000);
    }

    //默认是最后一个
    $cardType = $cardTypeList[count($cardTypeList) - 1];
    foreach ($cardNum as $index => $value) {
        if ($randomNum <= $value) {
            $cardType = $cardTypeList[$index];
            break;
        }
    }
    return $cardType;
}
date_default_timezone_set('Asia/Shanghai');



// $store = $cardTimeNum[$thisHour][$minute];//模拟库存
// echo "store:".$store.PHP_EOL;
// $keyName=$thisHour.$minute;
// $redis = new Redis();
// $result = $redis->connect('127.0.0.1',6379);
// $res = $redis->llen($keyName);
// echo $res."<br/>";
// if($res<$store){
//     $redis->lpush($keyName,"1".time());
//     echo '好运'.$redis->llen($keyName).PHP_EOL;
// }



