<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-11
 * Time: 下午3:13
 */
namespace app\admin\controller;

use think\Db;
use think\Request;
class Menu extends Base
{
    public function index()
    {
        return $this->fetch();
    }
    /*
     * 添加属性
     */
    public function attribute(Request $request)
    {
        //PAGEtype属性
        $pagetype=DB::name('menu')->field('id,name,value,type,status')->where('type','page_type')->select();
        $this->assign('pagetype',$pagetype);
        //fans属性
        $fans=DB::name('menu')->field('id,name,value,type,status')->where('type','fans')->select();
        $this->assign('fans',$fans);
        //page活跃度
        $pageact=DB::name('menu')->field('id,name,value,type,status')->where('type','page_activity')->select();
        $this->assign('pageact',$pageact);
        //用金比
        $commission=DB::name('menu')->field('id,name,value,type,status')->where('type','commission_ratio')->select();
        $this->assign('commission',$commission);
        //状态
        $stutus=DB::name('menu')->field('id,name,value,type,status')->where('type','status')->select();
        $this->assign('stutus',$stutus);
        return $this->fetch();
    }

    /*
     * 保存page
     */
    public function savePage(Request $request)
    {
        if($request->isPost()){
            $pagename = $request->post('name');
            $pagetype = $request->post('type');
            $res = Db::name('menu')->where('name',$pagename)->where('type',$pagetype)->find();
            $ret = [];
            if($res){
                $ret['status']=0;
                $ret['msg']="page类型已存在";
                return json($ret);
            }else{
                $date=[
                    'type'=>$pagetype,
                    'name'=>$pagename,
                    'create_time'=>date('Y-m-d H:m:s',time()),
                ];
                $ok = Db::name('menu')->insert($date);
                if($ok){
                    $ret['status']=1;
                    $ret['msg']="page类型添加成功";
                    return json($ret);
                }
            }
        }else{
            exit();
        }
    }
    /*
     * 保存fans
     */
    public function saveFans(Request $request)
    {
        if($request->isPost()){
            $fans = $request->post('fans');
            $fansval = $request->post('fans_value');
            $fantype = $request->post('type');
            $fn = Db::name('menu')->where('value',$fans)->where('type',$fantype)->find();
            if($fn){
                $ret['status']=2;
                $ret['msg']="粉丝代号已存在";
                return json($ret);
            }else{
                $fndate=[
                    'type'=>$fantype,
                    'value'=>$fans,
                    'status'=>$fansval,
                    'create_time'=>date('Y-m-d H:m:s',time()),
                ];
                $ad = Db::name('menu')->insert($fndate);
                if($ad){
                    $ret['status']=3;
                    $ret['msg']="粉丝数量添加成功";
                    return json($ret);
                }
            }
        }else{
            exit();
        }
    }
    /**
     * 保存page活跃度
     */
    public function savePageActivity(Request $request)
    {
        if($request->isPost()){
            $pv = $request->post('value');
            $ps = $request->post('status');
            $pt = $request->post('type');
            $pp = Db::name('menu')->where('value',$pv)->where('type',$pt)->find();
            $res=[];
            if($pp){
                $res['status']=0;
                $res['msg']="page活跃度代号已存在";
                return json($res);
            }else{
                $pd = [
                    'type'=>$pt,
                    'value'=>$pv,
                    'status'=>$ps,
                    'create_time'=>date('Y-m-d H:m:s',time()),
                ];
                $pad=Db::name('menu')->insert($pd);
                if($pad){
                    $res['status']=1;
                    $res['msg']="page活跃度添加成功";
                    return json($res);
                }
            }
        }else{
            exit();
        }
    }

    /**
     * 保存佣金比
     */
    public function saveCommission(Request $request)
    {
        if($request->isPost()){
            $cv = $request->post('value');
            $cs = $request->post('status');
            $ct = $request->post('type');
            $cp = Db::name('menu')->where('value',$cv)->where('type',$ct)->find();
            $res=[];
            if($cp){
                $res['status']=0;
                $res['msg']="佣金比代号已存在";
                return json($res);
            }else{
                $cd = [
                    'type'=>$ct,
                    'value'=>$cv,
                    'status'=>$cs,
                    'create_time'=>date('Y-m-d H:m:s',time()),
                ];
                $cad=Db::name('menu')->insert($cd);
                if($cad){
                    $res['status']=1;
                    $res['msg']="佣金比分类添加成功";
                    return json($res);
                }
            }
        }else{
            exit();
        }
    }

    /**
     * 保存status
     */
    public function saveStatus(Request $request)
    {
        if($request->isPost()){
            $sv = $request->post('value');
            $ss = $request->post('status');
            $st = $request->post('type');
            $sp = Db::name('menu')->where('value',$sv)->where('type',$st)->find();
            $res=[];
            if($sp){
                $res['status']=0;
                $res['msg']="佣金比代号已存在";
                return json($res);
            }else{
                $sd = [
                    'type'=>$st,
                    'value'=>$sv,
                    'status'=>$ss,
                    'create_time'=>date('Y-m-d H:m:s',time()),
                ];
                $spad=Db::name('menu')->insert($sd);
                if($spad){
                    $res['status']=1;
                    $res['msg']="佣金比分类添加成功";
                    return json($res);
                }
            }
        }else{
            exit();
        }
    }



    /**
     * 删除
     */
    public function delete(Request $request)
    {
        if($request->isGet()){
            $id = $request->get('id');
            if(empty($id)){
                exit('id不能为空');
            }else{
                $res = Db::name('menu')->where('id',$id)->delete();
                if($res)
                    $this->success('删除成功','/page/index/addAttribute');
            }
        }else{
            exit();
        }

    }
}