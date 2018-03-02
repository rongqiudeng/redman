<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-7
 * Time: 上午10:00
 */
namespace app\admin\model;

use think\Db;
use think\Session;
use app\admin\model\LogStaffLogins;
use app\admin\model\Roles;
class Staffs extends Base
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    /**
     * 判断用户登录帐号密码
     */
    public function checkLogin(){
        $loginName = input("post.userName");
        $loginPwd = input("post.loginPwd");
       /* $code = input("post.verifyCode");
        if(!RDAdminVerifyCheck($code)){
            return RDReturn('验证码错误!');
        }*/
        $staff = $this->where(['loginName'=>$loginName,'staffStatus'=>1,'dataFlag'=>1])->find();
        if(empty($staff))return RDReturn('账号错误!',1);
        if($staff['loginPwd']==md5($loginPwd.$staff['secretKey'])){
            $staff->lastTime = date('Y-m-d H:i:s');
            $staff->lastIP = request()->ip();
            $staff->save();
            //记录登录日志
            LogStaffLogins::create([
                'staffId'=>$staff['staffId'],
                'loginTime'=> date('Y-m-d H:i:s'),
                'loginIp'=>request()->ip()
            ]);
            /*//获取角色权限
            $role = Roles::get(['dataFlag'=>1,'roleId'=>$staff['staffRoleId']]);
            $staff['roleName'] = $role['roleName'];
            if($staff['staffId']==1){
                $staff['privileges'] = Db::name('privileges')->where(['dataFlag'=>1])->column('privilegeCode');
                $staff['menuIds'] = Db::name('menus')->where('dataFlag',1)->column('menuId');
            }else{
                $staff['privileges'] = explode(',',$role['privileges']);
                $staff['menuIds'] = [];
                //获取管理员拥有的菜单
                if(!empty($staff['privileges'])){
                    $menus = Db::name('menus')->alias('m')->join('__PRIVILEGES__ p','m.menuId=p.menuId and p.dataFlag=1','inner')
                        ->where(['p.privilegeCode'=>['in',$staff['privileges']]])->field('m.menuId')->select();
                    $menuIds = [];
                    if(!empty($menus)){
                        foreach ($menus as $key => $v){
                            $menuIds[] = $v['menuId'];
                        }
                        $staff['menuIds'] = $menuIds;
                    }
                }
            }*/
            $key = $staff->data;
            Session::set("RD_STAFF",$key);
            return RDReturn("登录成功",3,$staff);
        }
        return RDReturn('密码错误!',2);
    }
}