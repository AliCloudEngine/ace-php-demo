<?php
/**
 * ACE Demo by Snake.Zero
 * @copyright Alibaba group. since 2014
 */


error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-type: text/html; charset=utf-8");
$GLOBALS['demo_config'] = require "config.php";



class Demo
{
    /**
     * 是否是ace环境
     */
    static public function isAce()
    {
        static $is_ace = null;
        if (null == $is_ace) {
            $is_ace = false;
            $appid = ini_get('acl.app_id');
            if (false == empty($appid)) {
                $is_ace = true;
            }
        }
        return $is_ace;
    }

    static public function Mysql()
    {
        $connect = $GLOBALS['demo_config']['mysql'];
        $mysqli = new Mysqli($connect['host'], $connect['user'], $connect['pass'], $connect['db'], $connect['port']);
        return $mysqli;
    }

}
