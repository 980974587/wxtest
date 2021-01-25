<?php
//接收普通消息

require_once('Util.php');

//对传入的xml数据进行处理和转化
$fileContent = file_get_contents("php://input");
//禁止引用外部xml实体
libxml_disable_entity_loader(true);
//先把xml转换为simplexml对象，再把simplexml对象转换成 json，再将 json 转换成数组。
$value_array = json_decode(json_encode(simplexml_load_string($fileContent, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
$typeList = ['text', 'image', 'voice', 'video', 'shortvideo', 'location', 'link'];

$pdo = Util::getConnection();

//查重，如果已有记录就直接回复微信服务器
$sql = "SELECT * FROM msgs WHERE msgid=" . $value_array['MsgId'];
$result = $pdo->query($sql);
$result && exit("已存在，成功");

//存入记录
$valueSqlList = [array_search($value_array['MsgType'], $typeList), $value_array['FromUserName'], $value_array['CreateTime'], $value_array['MsgId'], $value_array['Content']];
$sql = "INSERT INTO `msgs`(type,from_openid,create_time,msgid,content) VALUES('" . implode("','", $valueSqlList) . "')";
$result = $pdo->query($sql);

echo $result ? '成功' : '失败';
