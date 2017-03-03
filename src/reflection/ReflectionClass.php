<?php
/**
 * Created by PhpStorm.
 * User: cyz
 * Date: 2017/3/3
 * Time: 上午9:56
 */

namespace NotesPHP\reflection;

/**
 * 反射对象处理
 *
 * Class ReflectionClass
 * @package NotesPHP\reflection
 */
class ReflectionClass
{
    private $reflection;

    /**
     * ReflectionClass constructor.
     * @param $className
     */
    public function __construct($className)
    {
        $this->reflection = new \ReflectionClass($className);
    }

    /**
     * 获取文档注释
     *
     * @return string
     */
    public function getDocComment()
    {
        return $this->reflection->getDocComment();
    }

    /**
     * 获取类数组
     *
     * @return \ReflectionMethod[]
     */
    public function getMethods()
    {
        return $this->reflection->getMethods();
    }

    /**
     * 获取方法反射对象
     *
     * @param $name
     * @return \ReflectionMethod
     */
    public function getMethod($name)
    {
        return $this->reflection->getMethod($name);
    }

    /**
     * 获取类型
     *
     * @param $class
     * @return string
     */
    public function getProperty($class)
    {
        return !$class->isPublic() ? !$class->isPrivate() ? $class->isProtected() ?: 'protected' : 'private' : 'public';
    }

    /**
     * 获取函数参数
     *
     * @param $class
     * @return array
     */
    public function getParameters($class)
    {
        $parameter_temp = $class->getParameters();
        if ($parameter_temp) {
            foreach ($parameter_temp as $parameter) {
                $fucntion[] = $parameter->name;
            }
        } else {
            $fucntion = [];
        }
        return $fucntion;
    }
}