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
        $config   = self::getConfig();
        $fileList = Directory::tree($config['base_path']);
        $json     = json_encode(self::getDom([$fileList]),320);
        Files::put($config['save_path'],$json);
    }

    private static function getDom($fileList)
    {
        $list = [];
        foreach ($fileList as &$arrValue){

            if($arrValue['file_list']){
                foreach ($arrValue['file_list'] as &$fileName){
                    $list[] = ClassInfo::getInfo($fileName);
                }
            }
            if($arrValue['dir_child']){
                $list   = array_merge($list,self::getDom($arrValue['dir_child']));
            }
        }
        return $list;
    }
    /**
     * @param array $arr
     * @return array
     */
    public static function setConfig(array $arr=[])
    {
        $config = [
            'base_path'=>dirname(__DIR__),
            'save_path'=>dirname(__DIR__).'/runtime/class.json',
            'extension'=>'php',
        ];
        $config = array_merge($config,$arr);
        return self::$config = $config;
    }

    public static function getConfig($field=null)
    {
        if(!isset(self::$config)){
            self::setConfig();
        }
        if( $field===null ){
            return self::$config;
        }
        return self::$config[$field];
    }
}