<?php

define('ROOT',__DIR__);
include_once('AccessToken.php');
include_once('Util.php');


// if($_GET['action']=='getTicket'){
//     $ticket=AccessToken::getUniqueInstance()->getTicket();
//     echo $ticket;
// }


// if($_GET['action']=='sign'){
//     try {
//         $paramList=['noncestr'=>$_GET['noncestr'],'timestamp'=>$_GET['timestamp'],'url'=>$_GET['url']];
        
//         $paramList['msg']=json_encode($paramList);
//         $paramList['code']=1;
//         exit(json_encode($paramList));

//         $jsSign=Util::genJsSign($paramList);
//         echo json_encode(['code'=>0,'sign'=>$jsSign]);
//     } catch (\Throwable $th) {
//         echo json_encode(['code'=>'1','msg'=>$th->getMessage()]);
//     }
// }

echo ['code'=>1,'msg'=>112233];