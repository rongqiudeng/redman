<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-9
 * Time: 上午10:35
 */
namespace app\admin\controller;

use think\Db;
use think\Request;
use think\Session;

class Page extends Base
{
    /*
     * page管理首页
     * @access public
     * @param string
     * @return fetch()
     */
    public function index()
    {
        $pagelist = Db::name('page')->order('id','asc')->paginate('10');
        $this->assign('userinfo',$pagelist);

        //搜索下拉框
        //佣金比
        $commission=DB::name('menu')->field('value,status')->where('type','commission_ratio')->select();
        $this->assign('yongjin',$commission);
        //粉丝
        $fans=DB::name('menu')->field('value,status')->where('type','fans')->select();
        $this->assign('fans',$fans);
        //PAGEtype属性
        $pagetype=DB::name('menu')->field('name')->where('type','page_type')->select();
        $this->assign('pagetype',$pagetype);
        //状态
        $stutus=DB::name('menu')->field('value,status')->where('type','status')->select();
        $this->assign('stutus',$stutus);
        //page活跃度
        $pageactivity=DB::name('menu')->field('value,status')->where('type','page_activity')->select();
        $this->assign('pageactivity',$pageactivity);
        return $this->fetch();
    }

    /**
     * 语言设置
     */
    public function lang() {
        switch ($_GET['lang']) {
            case 'cn':
                cookie('think_var', 'zh-cn');
                break;
            case 'en':
                cookie('think_var', 'en-us');
                break;
            //其它语言
        }
    }


    /**
     * 添加page信息
     *
     */
    public function addPage()
    {
        //佣金比
        $commission=DB::name('menu')->field('value,status')->where('type','commission_ratio')->select();
        $this->assign('yongjin',$commission);
        //粉丝
        $fans=DB::name('menu')->field('value,status')->where('type','fans')->select();
        $this->assign('fans',$fans);
        //PAGEtype属性
        $pagetype=DB::name('menu')->field('name')->where('type','page_type')->select();
        $this->assign('pagetype',$pagetype);
        //状态
        $stutus=DB::name('menu')->field('value,status')->where('type','status')->select();
        $this->assign('stutus',$stutus);
        //page活跃度
        $pageactivity=DB::name('menu')->field('value,status')->where('type','page_activity')->select();
        $this->assign('pageactivity',$pageactivity);
        return $this->fetch();
    }

    /**
     * 保存page信息
     * @param Request $request
     * @return mixed
     */
    public function savePageList(Request $request)
    {
        if($request->isPost()){
            $id = $request->post('id');
            if($id){
                $upd = [
                    'page_type' => $request->post('pagetype'),
                    'fans' => $request->post('fans'),
                    'page_activity' => $request->post('huoyuedu'),
                    'page_activity_status'=>getValue($request->post('huoyuedu')),
                    'commission' => $request->post('yongjin'),
                    'status' => $request->post('status'),
                    'status_value' =>getValue($request->post('status')),
                    'beizhu' => $request->post('beizhu'),
                    'update_time' => date('Y-m-d H:m:s'),
                ];
                $shengji = Db::name('page')->where('id',$id)->update($upd);
                if($shengji){
                    $this->success('修改成功','/admin/page/index');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $userid = $request->post('userid');
                $pageid = $request->post('pageid');
                $pagetype = $request->post('pagetype');
                $yongjin = $request->post('yongjin');
                $fans = $request->post('fans');
                $status = $request->post('status');
                $huoyuedu = $request->post('huoyuedu');
                $beizhu = $request->post('beizhu');
                $pagestatus = Db::name('menu')->field('value')->where('status',$huoyuedu)->find();
                $page_activity_status = implode($pagestatus);
                $statusvalue = Db::name('menu')->field('value')->where('status',$status)->find();
                $status_value=implode($statusvalue);
                $man = Db::name('page')->where('user_id',$userid)->find();
                if($man){
                    $this->error('UserID已经存在');
                }else{
                    $pdate=[
                        'user_id'=>$userid,
                        'page_id'=>$pageid,
                        'page_type'=>$pagetype,
                        'fans'=>$fans,
                        'page_activity'=>$huoyuedu,
                        'page_activity_status'=>$page_activity_status,
                        'commission'=>$yongjin,
                        'status'=>$status,
                        'status_value'=>$status_value,
                        'beizhu'=>$beizhu,
                        'create_time'=>date('Y-m-d H:m:s',time()),
                    ];
                    $res = Db::name('page')->insert($pdate);
                    if($res){
                        $this->success('添加成功','/admin/page/index');
                    }
                }
            }
        }else{
            exit();
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $yongjinbi = trim($request->post('yongjinbi'));
        $fansshuliang =trim($request->post('fansshuliang'));
        $zhuangtai = trim($request->post('zhuangtai'));
        $userid = trim($request->post('userid'));
        $pageid = trim($request->post('pageid'));
        $pagetypes = trim($request->post('pagetypes'));

//        dump($request->post());
        $where = [];
        if(!empty($yongjinbi)){
            $where['commission'] = ['like',"%$yongjinbi%"];
        }
        if(!empty($fansshuliang)){
            $where['fans'] = ['like',"%$fansshuliang%"];
        }
        if(!empty($zhuangtai)){
            $where['status'] = ['like',"%$zhuangtai%"];
        }
        if(!empty($pageid)){
            $where['page_id'] = ['like',"%$pageid%"];
        }
        if(!empty($pagetypes)){
            $where['page_type'] = ['like',"%$pagetypes%"];
        }
        if(!empty($userid)){
            $where['user_id'] = ['like',"%$userid%"];
        }
        $res = Db::name('page')->where($where)
            ->order('id asc')->paginate(15);
        $this->assign('userinfo',$res);
        //搜索下拉框
        //佣金比
        $commission=DB::name('menu')->field('value,status')->where('type','commission_ratio')->select();
        $this->assign('yongjin',$commission);
        //粉丝
        $fans=DB::name('menu')->field('value,status')->where('type','fans')->select();
        $this->assign('fans',$fans);
        //PAGEtype属性
        $pagetype=DB::name('menu')->field('name')->where('type','page_type')->select();
        $this->assign('pagetype',$pagetype);
        //状态
        $stutus=DB::name('menu')->field('value,status')->where('type','status')->select();
        $this->assign('stutus',$stutus);
        //page活跃度
        $pageactivity=DB::name('menu')->field('value,status')->where('type','page_activity')->select();
        $this->assign('pageactivity',$pageactivity);
        return $this->fetch('index');

    }
    /*
     * 编辑信息
     */
    public function editPage(Request $request)
    {
        if($request->isGet()){
            $id = $request->get('id');
            if(empty($id)){
                exit();
            }
            $pageInfo = Db::name('page')->where('id',$id)->find();
            //佣金比
            $commission=DB::name('menu')->field('value,status')->where('type','commission_ratio')->select();
            $this->assign('yongjin',$commission);
            //粉丝
            $fans=DB::name('menu')->field('value,status')->where('type','fans')->select();
            $this->assign('fans',$fans);
            //PAGEtype属性
            $pagetype=DB::name('menu')->field('name')->where('type','page_type')->select();
            $this->assign('pagetype',$pagetype);
            //状态
            $stutus=DB::name('menu')->field('value,status')->where('type','status')->select();
            $this->assign('stutus',$stutus);
            //page活跃度
            $pageactivity=DB::name('menu')->field('value,status')->where('type','page_activity')->select();
            $this->assign('pageactivity',$pageactivity);
            $this->assign('pageInfo',$pageInfo);
            return $this->fetch();
        }else{
            return;
        }
    }



}