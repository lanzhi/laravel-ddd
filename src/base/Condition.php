<?php
/**
 * Created by PhpStorm.
 * User: lanzhi
 * Date: 2018/5/22
 * Time: 下午6:27
 */

namespace lanzhi\ddd\base;


/**
 * Class Condition
 * @package lanzhi\ddd\base
 *
 * 从资源库中获取实体的过滤条件的显式抽象表示
 * 只要该类实例能够被相应的资源管理器理解，其可以包含任何内容
 */
abstract class Condition
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

}