<?php
/**
 * Created by PhpStorm.
 * User: selden
 * Date: 2017/2/28
 * Time: 17:36
 */

namespace NotesPHP;

use NotesPHP\reflection\ReflectionClass;

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
        $arrPath = pathinfo($fileName);
        $nameSpace = self::getNameSpace($arrPath['dirname'], $fileName);
        if (class_exists($nameSpace . '\\' . $arrPath['filename'])) {
            $refle = new ReflectionClass($nameSpace . '\\' . $arrPath['filename']);
            $arr = $refle->getMethods();
            $arrClass['name'] = $nameSpace . '\\' . $arrPath['filename'];
            $arrClass['doccomment'] = $refle->getDocComment();
            foreach ($arr as $item) {
                $funReflection = $refle->getMethod($item->name);
                $fucntion['name'] = $item->name;
                $parameter_temp = $funReflection->getParameters();
                $fucntion['property'] = $refle->getProperty($funReflection);
                if ($parameter_temp) {
                    foreach ($parameter_temp as $parameter) {
                        $fucntion['parameters'][] = $parameter->name;
                    }
                } else {
                    $fucntion['parameters'] = [];
                }
                $fucntion['doccomment'] = $funReflection->getDocComment();
                $arrClass['function'][] = $fucntion;
            }
            return $arrClass;
        }
        return false;
    }


    /**
     * 获取目录命名空间
     *
     * @param $dir
     * @param $fileName
     */
    private static function getNameSpace($dir, $fileName)
    {
        if (!isset(self::$_namespace[$dir])) {
            $string = file_get_contents($fileName);
            $string = substr($string, 0, strpos($string, ';'));
            $string = '\\' . end(explode(' ', $string));
            self::$_namespace[$dir] = $string;
        }
        return self::$_namespace[$dir];
    }
}