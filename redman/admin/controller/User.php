<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-10
 * Time: 下午6:49
 */
namespace app\admin\controller;

class User extends Base
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * 管理员列表
     * @return mixed|string
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 个人中心
     */
    public function personal()
    {
        return $this->fetch();
    }
}