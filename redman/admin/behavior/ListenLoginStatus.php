<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-6
 * Time: 下午6:18
 */
namespace app\admin\behavior;

class ListenLoginStatus
{
    public function run(&$params)
    {
        $STAFF = session('RD_STAFF');
        $allowUrl = [
            'admin/index/login',
            'admin/index/checklogin',
            'admin/index/logout',
            'admin/index/logout',
            'admin/index/getverify'
        ];
        $request = request();
        $visit = strtolower($request->module()."/".$request->controller()."/".$request->action());
        if(empty($STAFF) && !in_array($visit,$allowUrl)){
            if($request->isAjax()){
                return json(['status'=>-999,'msg'=>'对不起，您还没有登录，请先登录']);
            }else{
                header("Location:".url('admin/index/login'));
            }
            exit();
        }
    }
}