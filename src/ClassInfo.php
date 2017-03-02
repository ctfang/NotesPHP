<?php
/**
 * Created by PhpStorm.
 * User: selden
 * Date: 2017/2/28
 * Time: 17:36
 */

namespace NotesPHP;

/**
 * 获取类信息
 *
 * @package NotesPHP
 */
class ClassInfo
{
    /**
     * @var 命名空间映射
     */
    private static $_namespace;
    /**
     * 获取类信息
     *
     * @param $fileName
     * @return ReflectionClass
     */
    public static function getInfo($fileName)
    {
        $arrPath    = pathinfo($fileName);
        $nameSpace  = self::getNameSpace($arrPath['dirname'],$fileName);
        $refle      = self::getReflectionClass($nameSpace.'\\'.$arrPath['filename']);
        if(!$refle) return false;
        $funList    = $refle->getMethods();
        foreach ($funList as $item){

        }
    }

    /**
     * 获取反射对象
     *
     * @param $nameSpace
     * @return bool|\ReflectionClass
     */
    private static function getReflectionClass($nameSpace)
    {
        if( class_exists($nameSpace) ){
            return new \ReflectionClass($nameSpace);
        }
        return false;
    }

    /**
     * 获取目录命名空间
     *
     * @param $dir
     * @param $fileName
     */
    private static function getNameSpace($dir,$fileName)
    {
        if(!isset(self::$_namespace[$dir])){
            $string = file_get_contents($fileName);
            $string = substr($string,0,strpos($string,';'));
            $string = '\\'.end(explode(' ',$string));
            self::$_namespace[$dir] = $string;
        }
        return self::$_namespace[$dir];
    }
}