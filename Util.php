<?php

class Util
{
    /**
     * 读取指定配置文件的某个值
     *
     * @param string $key
     * @return array|false
     */
    static function getConfig($fileName,$key)
    {
        $fileName=ROOT.'/config/'.$fileName.".php";
        if(!is_file($fileName)){
            return false;
        }
        $_CFG = require $fileName;
        // 	global $_CFG;
        return self::getValueFromArray($_CFG, $key);
    }

    /**
     * 读取配置文件为数组
     */
    static function getConfigFile($fileName)
    {
        $fileName=ROOT.'/config/'.$fileName.".php";
        if(!is_file($fileName)){
            return false;
        }

        return require $fileName;
    }

    /**
     * 从指定数组中获取指定键名的值，如果键名为 NULL，则返回 NULL
     *
     * @param array $array
     * @param string $key
     * @return mixed|null
     */
    static function getValueFromArray($array, $key = null)
    {
        if ($key == null) {
            return $array;
        }
        return isset($array[$key]) ? $array[$key] : null;
    }
}
