<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-21
 * Time: 上午9:38
 */
namespace app\admin\controller;

use think\Db;
use think\Request;
class Product extends Base
{
    /**
     * 商品列表
     * @param Request $request
     * @return mixed|string
     */
    public function productList(Request $request)
    {
        $paixu = $request->get('order');
        if($paixu){
            $productlist = Db::name('product')->order('create_time',"$paixu")->paginate('10');
            $this->assign('productlist',$productlist);
            return $this->fetch();
        }
        $productlist = Db::name('product')->order('id','ASC')->paginate('10');
        $this->assign('productlist',$productlist);
        return $this->fetch();
    }

    /**
     * 商品搜索
     * @param Request $request
     * @return mixed|string|void
     */
    public function productSearch(Request $request)
    {
        if($request->isPost()){
            $id = trim($request->post('id'));
            $title = trim($request->post('title'));
            $sku = trim($request->post('sku'));
            $time = trim($request->post('create_time'));
            $where = [];
            if(!empty($id)){
                $where['id'] = ['like',"%$id%"];
            }
            if(!empty($title)){
                $where['title']=['like',"%$title%"];
            }
            if(!empty($sku)){
                $where['sku'] = ['like',"%$sku%"];
            }
            if(!empty($time)){
                $where['create_time'] = ['like',$time];
            }
            $res = Db::name('product')->where($where)
                ->order('id','asc')->paginate(10);
            $this->assign('productlist',$res);
            return $this->fetch('productlist');
        }else{
            return ;
        }
    }

    /**
     * 商品信息在帖子列表中显示
     * @param Request $request
     */
    public function setShow(Request $request)
    {
        if($request->get('id')){

        }else{
            return ;
        }
    }




}
