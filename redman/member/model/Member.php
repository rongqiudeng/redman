<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-20
 * Time: 下午4:21
 */
namespace app\member\model;


use think\Session;
class Member extends Base
{
    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * 登录检查
     * @return array
     */
    public function checkLogin()
    {
        $loginName = input("post.userName");
        $loginPwd = input("post.loginPwd");
        $user = $this->where(['name'=>$loginName,'workStatus'=>1,'staffStatus'=>1])->find();
        if(empty($user)){
            return RDReturn('Account error',1);
        }
        if($user['password']==md5($loginPwd.$user['secretKey'])){
            $data = $user->data;
            Session::set('RD_PASS',$data);
            return RDReturn('Login successful',3);
        }else{
            return RDReturn('Password error',2);
        }

    }

}