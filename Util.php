<?php
require_once 'AccessToken.php';
class Util
{
    private static $conn = null;
    /**
     * 读取指定配置文件的某个值
     * @param string $fileName config下的配置文件名
     * @param string $key 要读取的配置键名
     * @return array|false
     */
    static function getConfig($fileName, $key)
    {
        $fileName = ROOT . '/config/' . $fileName . ".php";
        if (!is_file($fileName)) {
            return false;
        }
        $_CFG = require $fileName;
        // 	global $_CFG;
        return self::getValueFromArray($_CFG, $key);
    }

    /**
     * 读取配置文件为数组
     * @return array|null|false
     */
    static function getConfigFile($fileName)
    {
        $fileName = ROOT . '/config/' . $fileName . ".php";
        if (!is_file($fileName)) {
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


    public static function getConnection()
    {
        if (is_null(self::$conn)) {
            $dbms = 'mysql';     //数据库类型
            $host = 'localhost'; //数据库主机名
            $dbName = 'wxtest';    //使用的数据库
            $user = 'root';      //数据库连接用户名
            $pass = '123';          //对应的密码
            $dsn = "$dbms:host=$host;dbname=$dbName";
    
    
            try {
                self::$conn = new PDO($dsn, $user, $pass); //初始化一个PDO对象
            } catch (PDOException $e) {
                die("Error!: " . $e->getMessage() . "<br/>");
            }
            // //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
            // self::$conn = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
        }
        return self::$conn;
    }

    public static function closeConnection(){
        if(!is_null(self::$conn)){
            self::$conn=null;
        }
    }

    public static function genJsSign($paramList){
        $ticket=AccessToken::getUniqueInstance()->getTicket();
        $paramList['jsapi_ticket']=$ticket;
        ksort($paramList);
        $toSign=urldecode(http_build_query($paramList));
        return $toSign;
        return sha1($toSign);
    }
}
