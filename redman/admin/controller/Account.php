<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-10
 * Time: 下午5:51
 */
namespace app\admin\controller;

use think\Db;
use think\Request;
class Account extends Base
{
    /**
     * 账户管理列表
     * @return mixed|string
     */
    public function index()
    {
        $list = Db::name('account')->order('id','asc')->paginate('10');
        $this->assign('accountlist',$list);
        return $this->fetch();
    }

    /**
     * 修改状态
     * @param Request $request
     * @return \think\response\Json|void
     */
    public function changeStatus(Request $request)
    {
        if($request->isPost()){
            $code = $request->post('code');
            $id = $request ->post('id');
            $res = [];
            if(empty($id)){
                $res['status']=0;
                return json($res);
            }else{
                $st = Db::name('account')->where('id',$id)->update(['status'=>$code]);
                if ($st){
                    $res['status']=1;
                    return json($res);
                }
            }
        }else{
            return;
        }
    }

    public function editAccount(Request $request)
    {
        if($request->get('id')){
            return $this->fetch();
        } else{
            return;
        }
    }

}