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
        $doc      = self::getDom([$fileList]);
        Files::put($config['save_path'],self::saveString($doc));
    }

    private static function saveString(array $data)
    {
        switch (self::getConfig('save_type')){
            case 'array':   return "<?php\n".var_export($data,TRUE).';';
            case 'json':    return json_encode($data,320);
        }
    }
    private static function getDom($fileList)
    {
        $list = [];
        foreach ($fileList as &$arrValue){

            if($arrValue['file_list']){
                foreach ($arrValue['file_list'] as &$fileName){
                    $info = ClassInfo::getInfo($fileName);
                    if($info){
                        $list[] = ClassInfo::getInfo($fileName);
                    }
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
            'save_type'=>'array'
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