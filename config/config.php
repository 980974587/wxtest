<?php
//配置
return array(
    'appid'=>'wx3f6c84918123741f',
    'secret'=>'9eebefa92a78d8bd47cbb4fed8368bf4',
    'returnUrl'=>'http://inkqx.nat300.top/index.php',
    'globaleTokenUrl'=>'https://api.weixin.qq.com/cgi-bin/token?',
    'baseCodeUrl'=>'https://open.weixin.qq.com/connect/oauth2/authorize?',
    'baseInfoUrl'=>'https://api.weixin.qq.com/sns/oauth2/access_token?',
    'userInfoUrl'=>'https://api.weixin.qq.com/cgi-bin/user/info?',
    'startime'=>'1611158400',
    // 'startime'=>'1611504000',
    'endtime'=>'1611504000',
    'expireTime'=>'7200',//token时效,单位秒
    'luckyCard'=>'860',
    // 'healthCard'=>'2000',
    // 'loveCard'=>'2000',
    // 'careerCard'=>'2000',
    // 'moneyCard'=>'2000',
    'luckyProb'=>'10',//好运牛的概率.单位%
    'healthProb'=>'20',
    'loveProb'=>'20',
    'careerProb'=>'20',
    'moneyProb'=>'30',
    'dayCardLimit'=>['400','140','120','50','50','50','50'],//每日限制可抽到的好运卡上限
    'dayRewardLimit'=>[
        ['1'=>[2,2,2,1,1,1,1]],
        ['2'=>[10,10,10,5,5,5,5]],
        ['3'=>[20,20,20,10,10,10]],
        ['4'=>[40,40,40,20,20,20]],
        ['5'=>[100,100,100,50,50,50,50]]
    ]
);