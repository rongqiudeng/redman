<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-9
 * Time: 下午6:29
 */
namespace app\admin\controller;

use think\Db;
use think\Request;
class Card extends Base
{
    /*
     * 贴子列表
     */
    public function index()
    {
        $cardlist = Db::name('card')->order('id','asc')->paginate('10');
        $this->assign('cardinfo',$cardlist);
        return $this->fetch();
    }

    /*
     * 搜索
     */
    public function search(Request $request)
    {
        if($request->isPost()){
            $id = trim($request->post('id'));
            $type = trim($request->post('fenlei'));
            $time = $request->post('times');
            $status = $request->post('status');
//            dump($request->post());
            $where = [];
            if(!empty($id)){
                $where['id'] = ['like',"%$id%"];
            }
            if(!empty($type)){
                $where['type'] = ['like',"%$type%"];
            }
            if(!empty($time)){
                $times = explode('-',$time);
                $start=date_format(date_create($times[0]), 'Y-m-d');
                $end=date_format(date_create($times[1]), 'Y-m-d');
                $where['create_time'] = ['between time',["$start","$end"]];
            }
            if($status != null){
                $where['status'] = $status;
            }
            $res = Db::name('card')->where($where)
                ->order('id','asc')->paginate(10);
            $this->assign('cardinfo',$res);
            return $this->fetch('index');
        }else{
            return ;
        }
    }

    /**
     * 添加帖子
     */
    public function addCard()
    {
        
        return $this->fetch();
    }

    /**
     * 保存card
     * @param Request $request
     */
    public function saveCard(Request $request)
    {
        if($request->isPost()){
            if($request->post('id')){
                $id = $request->post('id');
                $sta = $request->post('status');
                $url = $request->post('url/a');
                $uul = implode('@',$url);
                $msg = $request->post('content','','htmlspecialchars');
                $file = $request->file('file');
                if(empty($file)){
                    $cdate =[
                        'url'=>$uul,
                        'auther'=>getUserId(),
                        'content'=>$msg,
                        'type' =>1,
                        'status'=>$sta,
                        'create_time'=>date('Y-m-d ',time()),
                        'update_time'=>date('Y-m-d H:i:s',time()),
                    ];
                    $dok = Db::name('card')->where('id',$id)->update($cdate);
                    if($dok){
                        $this->success('修改成功','/admin/card/index');
                    }else{
                        $this->error('修改失败');
                    }
                }else{
                    $result = $this->validate(['file'=>$file],['file'=>'require|image'],['file.require'	=>'请选择上传文件','file.image'=>'非法图像文件']);
                    if($result!==true){
                        $this->error($result);
                    }
                    $md5 = $file->hash('md5');
                    $sha1 = $file->hash('sha1');
                    $img = Db::name('card')->where('md5',$md5)->where('sha1',$sha1)->find();
                    if($img) {
                        $this->error("图片文件已经存在");
                    }
                    $info = $file->move(ROOT_PATH.'upload'.DS.'card');
                    if($info){
                        $path = '/upload/card/'.date('Ymd',time()).'/'.$info->getFilename();
                        $cdate =[
                            'images_url'=>$path,
                            'url'=>$uul,
                            'auther'=>getUserId(),
                            'content'=>$msg,
                            'type' =>1,
                            'status'=>$sta,
                            'create_time'=>date('Y-m-d',time()  ),
                            'update_time'=>date('Y-m-d H:i:s',time()),
                        ];
                        $save = Db::name('card')->where('id',$id)->update($cdate);
                        if($save){
                            $this->success('保存成功','/admin/card/index');
                        }else{
                            $this->error('保存失败');
                        }
                    }else{
                        $this->error('上传失败'.$file->getError());
                    }

                }
            }else{
                $url = $request->post('url/a');
                $msg = $request->post('content','','htmlspecialchars');
                $file = $request->file('file');
                $uul =  implode('@',$url);
                if(empty($file)){
                    $this->error("请上传文件");
                }
                $result = $this->validate(['file'=>$file],['file'=>'require|image'],['file.require'	=>'请选择上传文件','file.image'=>'非法图像文件']);
                if($result!==true){
                    $this->error($result);
                }
                $info = $file->move(ROOT_PATH.'upload'.DS.'card');
                if($info){
                    $path = '/upload/card/'.date('Ymd',time()).'/'.$info->getFilename();
                    $cdate =[
                        'images_url'=>$path,
                        'url'=>$uul,
                        'auther'=>getUserId(),
                        'content'=>$msg,
                        'type' =>1,
                        'status'=>0,
                        'create_time'=>date('Y-m-d',time()),
                        'update_time'=>date('Y-m-d H:i:s',time()),
                    ];
                    $save = Db::name('card')->insert($cdate);
                    if($save){
                        $this->success('保存成功','/admin/card/index');
                    }else{
                        $this->error('保存失败');
                    }
                }else{
                    $this->error('上传失败'.$file->getError());
                }

            }
        }else{
            return;
        }

    }

    /**
     * 编辑card
     * @param Request $request
     * @return mixed|string|void
     */
    public function cardEdit(Request $request)
    {
        
        if($request->isGet()){
            $id = $request->get('id');
            if(empty($id)){
                return ;
            }
            $info = Db::name('card')->where('id',$id)->find();
            $this->assign('cardinfo',$info);
            return $this->fetch();
        }else{
            return ;
        }

    }

    /**
     * 编辑api请求
     * @param Request $request
     * @return array|\think\response\Json
     */
    public function editApi(Request $request)
    {
        if($request->isPost()){
            $id = $request->post('id');
            if($id){
                //->field('id,images_url,url,content')
                $info = Db::name('card')->where('id',$id)->find();
                return json($info);
            }else{
                return RDReturn('Id is emputy');
            }
        }else{
            return RDReturn('error');
        }

    }


    /*
     * 发送card
     */
    public function sendCard()
    {
        
        $id = Request::instance()->get('id');
        if($id){
            $db = array('status'=>1);
            $res = Db::name('card')->where('id',$id)->update($db);
            $ap = self::addPosts($id);
            if($res && $ap){
                $this->success('客户端已显示');
            }
        }else{
            return ;
        }

    }

    /*
     * 下架
     */
    public function resCard()
    {
        
        $id = Request::instance()->get('id');
        if($id){
            $res = Db::name('card')->where('id',$id)->update(['status'=>2]);
            $dp = self::delPosts($id);
            if($res && $dp){
                $this->success('客户端已下架');
            }
        }else{
            return ;
        }

    }

    /**
     * 添加posts数据
     * @param $id
     * @return int
     */
    public function addPosts($id)
    {
        if(!empty($id)){
            $list = Db::name('card')->where(['id'=>$id,'status'=>1])->find();
            $adddb=[
                'cid' => $list['id'],
                'images_url' => $list['images_url'],
                'url' => $list['url'],
                'text' =>$list['content'],
                'status'=>0,
                'createTime' => $list['update_time'],
            ];
            $res = Db::name('posts')->insert($adddb);
            if($res){
                return 1;
            }

        }else{
            return 0;
        }
    }

    /**
     * 联动更改下架操作
     * @param $id
     * @return int
     */
    public function delPosts($id)
    {
        if(!empty($id)){
            $res = Db::name('posts')->where(['cid'=>$id])->update(['status'=>2]);
            if($res){
                return 1;
            }
        }else{
            return 0;
        }
    }


}