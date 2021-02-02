<?php

define('ROOT',__DIR__);
include_once('AccessToken.php');
include_once('Util.php');

	function randomCard($hasLucky) {
	//读取概率配置
	$cardProb = ['yq' => 10, 'jk' => 22.5, 'aq' => 22.5, 'sy' => 22.5, 'cf' => 22.5];
	
	$cardTypeList = array_keys($cardProb);
	$cardNum = array_values($cardProb);

	//概率转为整数,并设置对应随机数范围
	$cardNum[0] = (int)100 * $cardNum[0];
	for($i = 1; $i < count($cardProb); $i++) {
		$cardNum[$i] = $cardNum[$i - 1] + (int)($cardNum[$i] * 100);
	}

	if($hasLucky) {
		$randomNum = random_int(1, 10000);
	} else {
		$randomNum = random_int($cardNum[0] + 1, 10000);
	}

	//默认是最后一个
	$cardType = $cardTypeList[count($cardTypeList) - 1];
	foreach($cardNum as $index => $value) {
		if($randomNum <= $value) {
			$cardType = $cardTypeList[$index];
			break;
		}
	}
	return $cardType;
}

$yq=$sy=$aq=$jk=$cf=0;
for($i=1;$i<21;$i++){
	$result=randomCard(true);
	echo $i.":".$result.PHP_EOL;
	$$result++;
}
echo "运气：".$yq.",事业：".$sy.",爱情:".$aq.",财富:".$jk.",健康:".$cf;