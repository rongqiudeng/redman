<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-6
 * Time: 下午6:39
 */
namespace app\admin\behavior;

class ListenPrivilege
{
    public function run(&$params)
    {
        $privileges = session('RD_STAFF.privileges');
        $urls = RDConf('listenUrl');
        $request = request();
        $visit = strtolower($request->module()."/".$request->controller()."/".$request->action());
        if(array_key_exists($visit,$urls) && !$this->checkUserCode($urls[$visit],$privileges)){
            if($request->isAjax()){
                echo json_encode(['status'=>-998,'msg'=>'对不起，您没有操作权限，请与管理员联系']);
            }else{
                header("Content-type: text/html; charset=utf-8");
                echo "对不起，您没有操作权限，请与管理员联系";
            }
            exit();
        }
    }
    private function checkUserCode($urlCodes,$userCodes){
        foreach ($urlCodes as $key => $value) {
            if(in_array($key,$userCodes))return true;
        }
        return false;
    }
}