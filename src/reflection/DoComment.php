<?php
/**
 * Created by PhpStorm.
 * User: cyz
 * Date: 2017/3/3
 * Time: 下午6:12
 */

namespace NotesPHP\reflection;

/**
 * 注释文档处理
 *
 * @package NotesPHP\reflection
 */
class DoComment
{
    private $docomment;

    public function __construct($string)
    {
        $this->docomment = $string;
    }
}