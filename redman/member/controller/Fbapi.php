<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-28
 * Time: 上午10:26
 */
namespace app\member\controller;

use think\Request;
use think\Db;
use Facebook\Facebook;
use think\Session;
class Fbapi extends Base
{
    public function sendMsg($id)
    {
        if($id){
            $fb = new Facebook([
                'app_id' => config('facebook.app_id'),
                'app_secret' => config('facebook.app_secret'),
                'default_graph_version' => config('facebook.default_graph_version'),
            ]);
            $key = Session::get('fb_access_token.idToken');
            $msgInfo = Db::name('posts')->where('id',$id)->find();
            $urlList = explode('@',$msgInfo['url']);
            $uid = Session::get('fb_access_token.uid');
            $urlInfo = [];
            foreach ($urlList as $v){
                $longUrl =  $v."&uid=$uid";
                $shurtURL= self::createShortUrl($longUrl);
                array_push($urlInfo,$shurtURL);
            }
            $newText =  preg_replace_callback("/\#url(\d+)/i",
                function($matches) use ($urlInfo){
                    return $urlInfo[$matches[1] - 1];
                },
                $msgInfo['text']
            );

            $data = [
                'message' => $newText,
                'source' => $fb->fileToUpload(".".$msgInfo['images_url']),
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

}