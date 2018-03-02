<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-20
 * Time: 下午3:58
 */
namespace app\member\controller;

use think\Db;
use think\Request;
use think\Session;
use Facebook\Facebook;
class User extends Base
{
    /**
     * 个人中心
     * @return mixed
     */
    public function personal()
    {
        $name=getMemberName();
        $userInfo = Db::name('member')->where('name',$name)->find();
        $this->assign('userinfo',$userInfo);
        return $this->fetch();
    }
    /**
     * 修改信息
     * @param Request $request
     * @return \think\response\Json|void
     */
    public function changeInfo(Request $request)
    {
        if ($request->isPost()) {
            $uid = $request->post('id');
            $name = $request->post('userName');
            $sex = $request->post('sex');
            $email = $request->post('email');
            $rtd = [];
            if (!empty($uid)) {
                $res = Db::name('staffs')->where('staffId', $uid)->update(['loginName' => $name, 'sex' => $sex, 'email' => $email]);
                if ($res) {
                    $rtd['status'] = 1;
                    $rtd['msg'] = "修改成功!";
                    return json($rtd);
                }else{
                    $rtd['status'] = 2;
                    $rtd['msg'] = "未做任何修改!";
                    return json($rtd);
                }
            } else {
                $Im = getUserId();
                $res = Db::name('staffs')->where('loginName', $Im)->update(['loginName' => $name, 'sex' => $sex, 'email' => $email]);
                if ($res) {
                    $rtd['status'] = 1;
                    $rtd['msg'] = "修改成功!";
                    return json($rtd);
                }

            }
        } else {
            return;
        }
    }

    /**
     * 修改密码
     * @param Request $request
     * @return array|void
     */
    public function changePwd(Request $request)
    {
        if ($request->isPost()) {
            $uid = $request->post('id');
            $oldPwd = $request->post('oldPwd');
            $pwd1 = $request->post('newPwd');
            $pwd2 = $request->post('newPw');
            if (!empty($uid)) {
                $res = Db::name('member')->where('uid', $uid)->find();
                if ($res['password'] != md5($oldPwd . $res['secretKey'])) {
                    return RDReturn('Old password error!!', 2);
                }
                if ($pwd1 != $pwd2) {
                    return RDReturn('The two password is inconsistent!', 3);
                }
                $change = Db::name('member')->where('uid', $uid)->update(['password' => md5($pwd2 . $res['secretKey'])]);
                if ($change) {
                    return RDReturn('Successful modification!', 1);
                }
            } else {
                $Im = getMemberName();
                $res = Db::name('member')->where('name', $Im)->find();
                if ($res['password'] != md5($oldPwd . $res['secretKey'])) {
                    return RDReturn('Old password error!', 2);
                }
                if ($pwd1 != $pwd2) {
                    return RDReturn('The two password is inconsistent!', 3);
                }
                $change = Db::name('member')->where('loginName', $Im)->update(['password' => md5($pwd2 . $res['secretKey'])]);
                if ($change) {
                    return RDReturn('Successful modification!', 1);

                }
            }
        } else {
            return;
        }
    }

    /**
     * 帖子列表
     * @param Request $request
     * @return mixed
     */
    public function postsList(Request $request)
    {
        $uid = getMemberUid();
        $postsInfo = Db::name('posts')->field('id,images_url,url,text,createTime,status')->paginate('10');
        $this->assign('postsinfo',$postsInfo);
        $pid = Db::name('page')->field('page_id')->where('user_id',$uid)->select();
        $this->assign('pid',$pid);
        return $this->fetch();
    }

    /**
     * postsSearch
     * @param Request $request
     * @return mixed|void
     */
    public function postsSearch(Request $request)
    {
        if($request->isPost()){
            $id = $request->post('id');
            $text = $request->post('text');
            $time = $request->post('time');
            $status = $request->post('status');
            $where = [];
            if(!empty($id)){
                $where['id']=['like',"%$id%"];
            }
            if(!empty($text)){
                $where['text']=['like',"%$text%"];
            }
            if(!empty($time)){
                $where['createTime']=['like',"%$time%"];
            }
            if(!empty($status)){
                $where['status']=['like',"%$status%"];
            }
            $res = Db::name('posts')->where($where)->order('id','asc')->paginate('10');
            $this->assign('postsinfo',$res);
            return $this->fetch('postslist');
        }else{
            return;
        }
    }

    /**
     * 帖子详情
     * @return mixed
     */
    public function details(Request $request)
    {
        if($request->get('id')){

            return $this->fetch();
        }else{
            return;
        }
    }

    /**
     * 发送帖子
     * @param Request $request
     */
    public function sendMsg(Request $request)
    {
        $id = $request->get('id');
        if($id){
            $api = new Fbapi();
            $res = $api->sendMsg($id);
            if($res == 1){
                Db::name('posts')->where('id',$id)->update(['status'=>1]);
                $this->success('seccess','/member/user/postsList');
            }
        }else{
            return;
        }
    }

    /**
     * 动态添加定时任务
     * @param Request $request
     */
    public function addTimeJob(Request $request)
    {
        $redisApi = new \Redis();
        $redisApi->connect('127.0.0.1',6379);
        $redisApi->select(0);
//        $redisApi->flushDB();
//        $time = strtotime($request->get('time'));

        for ($i = 0; $i < 5; ++$i)  {
            $time = time() + 60 * $i;
//            $time = strtotime('2017/12/9 19:26:00');
//        $time = 1544544000;

            $id = $request->get('id');
            $uid = 140470486718201;
            $token = 'EAACuGCwLx6ABAHftzenLL35NSXAlteSVkP2Wc0eOhE1mqpe4SgbDanL1wj13W9lW7qkuWlB4mchmwZA2QuFzLqZA276Eo18ZAuPnffeBeWWBVFvaf3sHv55OREmitNSe2t7ZBR5C4Y2k77ZBbBwUMvmLZBHIagZAnQYkPNUbZBa507SzB3Th03Aa';
            $info = Db::name('posts')->field("images_url,url,text")->where('id',$id)->find();
            $urlList = explode('@',$info['url']);
            $urlInfo = [];
            foreach ($urlList as $u){
                $longUrl =  $u."&uid=$uid";
                $shurtURL= self::createShortUrl($longUrl);
                array_push($urlInfo,$shurtURL);
            }
            $newText =  preg_replace_callback("/\#url(\d+)/i",
                function($matches) use ($urlInfo){
                    return $urlInfo[$matches[1] - 1];
                },
                $info['text'] .' Current Date: '. date('Y-m-d H:i:s', $time)
            );
            $url = $info['images_url'];
            $redisApi->zAdd('news', $time,"$token@$newText@$url@$time");
            dump($redisApi->zRange('news','0' ,'-1'));
        }

    }


    /**
     * 订单列表
     * @param Request $request
     * @return mixed
     */
    public function orderList(Request $request)
    {

        return $this->fetch();
    }


    public function redisTest()
    {
        $config = [
        'host' => '127.0.0.1',
        'port' => 6379,
        'password' => '',
        'select' => 0,
        'timeout' => 0,
        'expire' => 0,
        'persistent' => false,
        'prefix' => '',
    ];
        $Api = new RedisApi($config);
        //输出String(字符串) 实例
        $Api->set("name","lisi");
        echo "<h3>输出String(字符串) 实例</h3>";
        dump($Api->get('name'));

        dump(strtotime('2017/12/2 11:20:2'));
        dump(date('Y-m-d H:m:s','1512184832'));
        dump(date('Y-m-d H:m:s','1512184802'));
    }

    public function redis()
    {
        $redisApi = new \Redis();
        $redisApi->connect('127.0.0.1',6379);
        $redisApi->flushDB();
        $msgInfo = Db::name('posts_job')->field("uid,token,images_url,url,text,timing")->where('status',0)->select();
        $number = count($msgInfo);
        foreach ($msgInfo as $k=>$v){
            $urlList = explode('@',$v['url']);
            $uid = $v['uid'];
            $urlInfo = [];
            foreach ($urlList as $u){
                $longUrl =  $u."&uid=$uid";
                $shurtURL= self::createShortUrl($longUrl);
                array_push($urlInfo,$shurtURL);
            }
            $newText =  preg_replace_callback("/\#url(\d+)/i",
                function($matches) use ($urlInfo){
                    return $urlInfo[$matches[1] - 1];
                },
                $v['text']
            );
            $token = $v['token'];
            $url = $v['images_url'];
            $redisApi->zAdd('news', strtotime($v['timing']),"$token@$newText@$url");
        }
            $newsCount = $redisApi->zCount('news','-inf','+inf');
            if($number == $newsCount){
            //按时间由低到高排序
            $newsArray=$redisApi->zRange('news', 0,$newsCount);
            foreach ($newsArray as $n)
            {
                $sendInfo = explode('@',$n);
                dump($sendInfo);
                $Fbresponse = self::FbSend($sendInfo[0],$sendInfo[1],$sendInfo[2]);
                if($Fbresponse == 1){
                    //清除集合中排名最低的
                    $redisApi->zRemRangeByRank('news',0,$newsCount);
                }
                Db::name('posts_job')->where('token',$sendInfo[0])->update(['status'=>1]);
            }


        }


    }

    /**
     * 谷歌短连接api
     * @param $langurl
     * @param $shorturl
     * @return bool
     */
    public function createShortUrl($langurl)
    {
        $key = config('google.key');
        // Create instance with key
        $googer = new GoogleApi($key);
        // Test: Shorten a URL
        $shorURL = $googer->shorten($langurl);
        return $shorURL;
        // Test: Expand a URL
        //  $longURL = $googer->expand($shorturl);
        //  return $longURL;
    }

    /**
     * Facebook发送函数
     * @param $key
     * @param $text
     * @param $url
     * @return int
     */
    public function FbSend($key,$text,$url)
    {
        $fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.default_graph_version'),
        ]);
        $data = [
            'message' => $text,
            'source' => $fb->fileToUpload(".".$url),
        ];
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->post('/me/photos', $data, $key);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $graphNode = $response->getGraphNode();
        if($graphNode['id']){
            return 1;
        }else{
            return 0;
        }
    }


}
