<?php
/**
 * Created by PhpStorm.
 * User: selden1992
 * Date: 2017/2/23
 * Time: 22:13
 */

namespace NotesPHP;


class NotesPHP
{
    protected static $config;

    public static function build()
    {
        $config = self::getConfig();
        $fileList = Directory::tree($config['base_path']);
        $json   = self::getDom($fileList);
        Files::put($config['save_path'],$json);
    }

    private static function getDom($fileList)
    {
        foreach ($fileList as &$arrValue){
            
        }
    }
    /**
     * @param array $arr
     * @return array
     */
    public static function setConfig(array $arr=[])
    {
        $config = [
            'base_path'=>dirname(__DIR__),
            'save_path'=>__DIR__.'/runtime/class.json',
        ];
        $config = array_merge($config,$arr);
        return self::$config = $config;
    }

    protected static function getConfig()
    {
        if(!isset(self::$config)){
            self::setConfig();
        }
        return self::$config;
    }
}