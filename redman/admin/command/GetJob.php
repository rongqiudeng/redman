<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-12-5
 * Time: 下午3:49
 */
namespace app\admin\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use app\member\controller\GoogleApi;
use Facebook\Facebook;
class GetJob extends Command
{
    protected function configure()
    {
        $this->setName('GetJob')->setDescription('这是Redis订阅接收命令 ');
    }

    public function redisPublis()
    {
        $redisApi = new \Redis();
        $redisApi->connect('127.0.0.1',6379);
        dump('PUBLISH(接收订阅)开始：');
        $redisApi->subscribe(['redisChat'],function($instance, $channelName, $message) {
            echo $channelName, "==>", $message,PHP_EOL;
        });
        // 回调函数,这里写处理逻辑
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

    protected function execute(Input $input, Output $output)
    {
        $redisApi = new \Redis();
        $redisApi->connect('127.0.0.1',6379);
        $redisApi->select(0);
//        $redisApi->flushDB();
        while (1){
            $jobList = $redisApi->zRange('news','0', '-1');
            foreach ($jobList as $k=>$v){
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
        }

        $output->writeln("运行结束");
    }
}
