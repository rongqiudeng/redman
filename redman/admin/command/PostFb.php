<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-12-4
 * Time: 下午6:20
 */
namespace app\admin\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use app\member\controller\GoogleApi;
use Facebook\Facebook;
class PostFb extends Command
{
    /**
     * 命令说明
     */
    protected function configure()
    {
        $this->setName('PostFb')->setDescription('这是Facebook发送命令 ');
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

    /**
     * Cli发送函数
     * @param Input $input
     * @param Output $output
     */
    protected function execute(Input $input, Output $output)
    {
        $redisApi = new \Redis();
        $redisApi->connect('127.0.0.1',6379);
        $redisApi->select(1);
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
            $byTime = strtotime($v['timing']);
            $redisApi->zAdd('news', $byTime,"$token@$newText@$url@$byTime");
//          $redisApi->zAdd('news', $byTime,"{'token':'$token' ,'text':'$newText' , 'url':'$url' ,'time':'$byTime'}");
        }
        $newsCount = $redisApi->zCount('news','-inf','+inf');
        if($number == $newsCount){
            //按时间由低到高排序
            $newsArray=$redisApi->zRange('news', 0,$newsCount);
            dump("这是需要发送的任务：");
            dump($newsArray);
            foreach ($newsArray as $n)
            {
                $sendInfo = explode('@',$n);
                dump('计时开始:');
                while (1) {
                    sleep(1);
                    dump('现在时间：'.time().'--------'.'计划发送时间：'.$sendInfo[3]);
                    if(time()==$sendInfo[3]){
                        dump('开始发送:');
                        $Fbresponse = self::FbSend($sendInfo[0],$sendInfo[1],$sendInfo[2]);
                        if($Fbresponse == 1){
                            //清除集合中排名最低的
                            dump('一条page发送成功');
                            $redisApi->zRemRangeByRank('news',0,$newsCount);
                        }else{
                            $output->writeln("发送失败，请检查链接");
                            exit();
                        }
                        Db::name('posts_job')->where('token',$sendInfo[0])->update(['status'=>1]);
                        break;
                    }elseif($sendInfo[3] == null){
                        break;
                    }
                }
            }
        }
        $output->writeln("集合中所有定时任务已经执行完成，运行结束");
    }
}
