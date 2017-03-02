<?php
/**
 * Created by PhpStorm.
 * User: selden
 * Date: 2017/2/28
 * Time: 17:36
 */

namespace NotesPHP;


class ClassInfo
{
    public static function getInfo($nameSpace)
    {
        $refle = self::getReflectionClass($nameSpace);
        return $refle;
    }

    private static function getReflectionClass($nameSpace)
    {
        return new ReflectionClass($nameSpace);
    }
}