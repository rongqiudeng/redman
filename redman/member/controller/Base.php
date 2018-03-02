<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-20
 * Time: 下午4:01
 */
namespace app\member\controller;

use think\Controller;
use think\Session;
class Base extends Controller
{
    public function _initialize()
    {
        $FbSession = Session::get('fb_access_token');
        $MemberSession = Session::get('RD_PASS');
        if($FbSession==null && $MemberSession==null){
            Session::set('fb_access_token',null);
            Session::set('RD_PASS',null);
            return $this->error('Login timeout, please login again','/member/login/index');
        }
    }


}