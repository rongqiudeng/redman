<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-7
 * Time: 下午4:31
 */
namespace app\admin\controller;

use think\Controller;
use think\Session;
use app\admin\model\Staffs;
class Login extends Controller
{
    /*
     * 登录
     */
    public function index()
    {
        if (Session::get('RD_STAFF') != null) {
            $this->success('Is login','/admin/page/index');
        }else{
            return $this->fetch('/login');
        }
    }

    /**
     * 登录验证
     */
    public function checkLogin()
    {
        $m = new Staffs();
        return $m->checkLogin();
    }

    /**
     * 退出登录
     */
    public function goOut()
    {
        Session::set('RD_STAFF',null);
        $this->success("退出成功！",'admin/login/index');
    }
}