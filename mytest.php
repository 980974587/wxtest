<?php

define('ROOT',__DIR__);
include_once('AccessToken.php');
include_once('Util.php');

$var =Util::getConfigFile('testConfig');
var_dump($var);