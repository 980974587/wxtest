<?php

require_once('Util.php');
define("ROOT",__DIR__);
for($i=1;$i<21;$i++){
    //已有金牛||集齐
    //今日上限
    $hasRight=hasRight();
    if(empty($hansRight)){

    }
    //echo "已有抽奖权利,无法扫码";
    echo "第 $i 次:";
    randomCard();
    echo PHP_EOL;
}

function hasRight(){
    //400 100 100 50 50 50 50
    $startime=Util::getConfig('config','startime');
    $endtime=Util::getConfig('config','endtime');
    $now=time();
    //1611158400
    if($now<$startime){
        return '活动未开始';
    }
    if($now>$endtime){
        return "活动已结束";
    }
    $actDay=intdiv((time()-$startime),86400)+1;
    // echo "活动第 $actDay 天";
    return '';
}


//限定是否有好运卡的纯概率抽卡
function randomCard($hasLucky=true){
    $luckyProb=Util::getConfig('config','luckyProb');
    $healthProb=$luckyProb+Util::getConfig('config','healthProb');
    $loveProb=$healthProb+Util::getConfig('config','loveProb');
    $careerProb=$loveProb+Util::getConfig('config','careerProb');
    if($hasLucky){
        $randomNum=random_int(1,100);
    }else{
        $randomNum=random_int($luckyProb+1,100);
    }
    $result='';
    switch ($randomNum) {
        case $randomNum<=$luckyProb:
            $result="恭喜您抽中好运卡";
            break;
        case $randomNum<=$healthProb:
            $result="恭喜您抽中健康卡";
            break;
        case $randomNum<=$loveProb:
            $result="恭喜您抽中爱情卡";
            break;
        case $randomNum<=$careerProb:
            $result="恭喜您抽中事业卡";
            break;
        default:
            $result="恭喜您抽中财富卡";
            break;
    }

    $cardType=['luckeyCard','healthCard','loveCard','careerCard','moneyCard'];
    echo $result;

    return ;
}