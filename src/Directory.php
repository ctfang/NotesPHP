<?php
/**
 * Created by PhpStorm.
 * User: selden1992
 * Date: 2017/2/23
 * Time: 22:24
 */

namespace NotesPHP;


class Directory
{
    /**
     * 获取一层目录
     *
     * @param $path
     * @return array
     */
    public static function dirList($path)
    {
        $lists = scandir($path);
        if( count($lists)<4 ) return ['dir_list'=>[],'file_list'=>[]];
        $dir   = $files = [];
        $ext   = NotesPHP::getConfig('extension');
        $extCt = strlen($ext);
        foreach ($lists as $key => $name) {
            if (in_array($name, ['.', '..']) ) {
                unset($lists[$key]);
            } elseif( is_dir($dirPath = $path . '/' . $name) ) {
                $dir[] = $dirPath;
            }elseif( substr($dirPath,-$extCt)==$ext ){
                $files[] = $dirPath;
            }
        }
        return ['dir_list'=>$dir,'file_list'=>$files];
    }

    /**
     * 获取目录树
     *
     * @param $path
     * @return array
     */
    public static function tree($path)
    {
        $list = [];

        if (is_dir($path)) {
            $temp                = self::dirList($path);
            $list['dir_path']  = $path;
            $list['file_list'] = $temp['file_list'];
            $list['dir_child'] = [];
            foreach ($temp['dir_list'] as $item) {
                $list['dir_child'][]    = self::tree($item);
            }
        }
        return $list;
    }
}