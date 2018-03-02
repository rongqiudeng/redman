<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-6
 * Time: 下午3:08
 */

namespace app\portal\controller;

use think\Controller;
use think\Request;
use think\Db;
use Facebook\Facebook;
use think\Session;

class Index extends Controller
{
    /**
     * 首页显示登录
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

}