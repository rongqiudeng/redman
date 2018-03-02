<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-12-8
 * Time: 下午4:42
 */
namespace app\admin\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use Facebook\Facebook;
class ListSendPage extends Command
{
    /**
     * 命令说明
     */
    protected function configure()
    {
        $this->setName('ListSendPage')->setDescription('这是发送任务的命令 ');
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
     * 无限循环定时处理任务
     * @param Input $input
     * @param Output $output
     */
    protected function execute(Input $input, Output $output)
    {
        $redisApi = new \Redis();
        $redisApi->connect('127.0.0.1',6379);
        $redisApi->select(0);

        while (true) {

            echo 'Now Date:' . date('Y-m-d H:i:s') . "\r\n";

            //按时间由低到高排序
            $newsArray = $redisApi->zRange('news', '0', '0');
            if (empty($newsArray)) {
                dump("Queue is empty\r\n");
                sleep(1);
                continue;
            }

            $temp = explode('@', $newsArray[0]);
            echo 'Post send date '. date('Y-m-d H:i:s', $temp[3]) . "\r\n";

            if ($temp[3] <= time()) {
                print("Start try send.\r\n");
                // sendPostApi
                $result = self::FbSend($temp[0], $temp[1], $temp[2]);
                var_dump($result);
                print("Send Facebook post.\r\n");

                if ($result == 1) {
                    $redisApi->zRemRangeByRank('news', 0, 0);
                }
            } else {
                sleep(1);
            }
        }
    }
}

