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

    /**
     * 创建
     */
    public static function build()
    {
        $config   = self::getConfig();
        $fileList = Directory::tree($config['base_path']);
        $doc      = self::getDom([$fileList]);
        Files::put($config['save_path'],self::saveString($doc));
    }

    /**
     * 保存
     *
     * @param array $data
     * @return string
     */
    private static function saveString(array $data)
    {
        switch (self::getConfig('save_type')){
            case 'array':   return "<?php\nreturn ".var_export($data,TRUE).';';
            case 'json':    return json_encode($data,320);
        }
    }

    /**
     * 获取注释信息
     *
     * @param $fileList
     * @return array
     */
    private static function getDom($fileList)
    {
        $list = [];
        foreach ($fileList as &$arrValue){
            if($arrValue['dir_child']){
                $list   = array_merge($list,self::getDom($arrValue['dir_child']));
            }
            if($arrValue['file_list']){
                foreach ($arrValue['file_list'] as &$fileName){
                    $info = ClassInfo::getInfo($fileName);
                    if($info){
                        $list[] = $info;
                    }
                }
            }
        }
        return $list;
    }
    /**
     * 设置配置
     *
     * @param array $arr
     * @return array
     */
    public static function setConfig(array $arr=[])
    {
        $config = include_once __DIR__.'/../config/config.php';
        $config = array_merge($config,$arr);
        return self::$config = $config;
    }

    /**
     * 获取配置
     *
     * @param null $field
     * @return mixed
     */
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