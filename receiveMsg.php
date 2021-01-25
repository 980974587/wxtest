<?php

$fileContent = file_get_contents("php://input");
//禁止引用外部xml实体
libxml_disable_entity_loader(true);
//先把xml转换为simplexml对象，再把simplexml对象转换成 json，再将 json 转换成数组。
$value_array = json_decode(json_encode(simplexml_load_string($fileContent, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

$valueSqlList=[$value_array['MsgType'],$value_array['FromUserName'],$value_array['CreateTime'],$value_array['MsgId'],$value_array['Content']];

$sql="INSERT INTO `msgs`(type,from_openid,create_at,msgid,content) VALUES(".implode(",",$valueSqlList).")";
echo $value_array['FromUserName'];
