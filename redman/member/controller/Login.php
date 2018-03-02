<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-20
 * Time: 下午4:01
 */
namespace app\member\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;
use app\member\model\Member;
use Facebook\Facebook;
class Login extends Controller
{
    /**
     * 会员登录
     * @return mixed
     */
    public function index()
    {
        if (Session::get('RD_PASS')) {
            $this->success('Is login','/member/user/orderList');
        }else{
            $fb = new Facebook([
                'app_id' => config('facebook.app_id'),
                'app_secret' => config('facebook.app_secret'),
                'default_graph_version' => config('facebook.default_graph_version'),
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email','publish_actions','manage_pages','publish_pages']; // Optional permissions
            $host = $_SERVER['SERVER_NAME'];
            $loginUrl = $helper->getLoginUrl("http://.$host./member/login/fbcallback", $permissions);
            $this->assign('url', $loginUrl);

            return $this->fetch('/login');
        }
    }

    /**
     * 检查登录
     */
    public function checkLogin()
    {
        $m = new Member();
        return $m->checkLogin();
    }

    /**
     * 退出登录
     */
    public function goOut()
    {
        Session::set('RD_PASS',null);
        Session::set('fb_access_token',null);
        $this->success('Is go out!','/member/login/index');
    }

    /**
     * facebook登录回调
     */
    public function fbcallback()
    {
        if (Session::get('fb_access_token') != null) {
            $this->success('Is login','/member/user/orderList');
        }
        $fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.default_graph_version'),
        ]);
        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        // Logged in
        $key = $accessToken->getValue();
        $fb->setDefaultAccessToken("$key");
        $response = $fb->get('/me?locale=en_US&fields=id,name,email,first_name,last_name,picture');
        $userNode = $response->getGraphUser();

        $userInfo = [];
        // Get the name of the logged in user
        $userInfo['uid'] =$userNode->getId();
        $userInfo['idToken'] =$key ;
        $userInfo['userType'] =1 ;
        $userInfo['userName'] =$userNode->getName();
        $userInfo['firstName'] =$userNode->getFirstName();
        $userInfo['lastName'] =$userNode->getLastName();
        $userInfo['email'] =$userNode->getEmail();
        $userInfo['picture'] =$userNode->getPicture()->getUrl();
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        $createtime = (array)$tokenMetadata->getIssuedAt();
        $scope = $tokenMetadata->getScopes();
        $endTime = (array)$tokenMetadata->getExpiresAt();
        $userInfo['createTime'] = $createtime['date'];
        $userInfo['scopes'] = implode(',',$scope);
        $userInfo['endTime'] = $endTime['date'];
        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId('191418841417632'); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();
        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
            echo '<h3>Long-lived</h3>';
            $accessToken->getValue();
        }
        //clean register session
        Session::set('IsRegister',null);
        //add session
        Session::set('fb_access_token', $userInfo);
        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
        $userFind = Db::name('fbuser')->where('uid',$userInfo['uid'])->find();
        if($userFind){
            Db::name('fbuser')->where('uid',$userInfo['uid'])->update(['idToken'=>$key]);
            $this->success('success','/member/user/orderList');
        }else{
            $res = Db::name('fbuser')->insert($userInfo);
            if ($res) {
                $this->success('success','/member/user/orderList');
            } else {
                $this->error('failed');
            }
        }
    }

    /**
     * 用户注册
     * @param Request $request
     * @return array|void
     */
    public function doRegister(Request $request)
    {
        if($request->isPost()){
            $email = $request->post('email');
            $password = $request->post('passwd');
            $ppid = $request->post('ppid');
            $pptel = $request->post('pptel');
            $key = '1024' ;
            $psd = md5($password.$key);
            $result = $this->validate(['email'=> $email,'ppid'=>$ppid],['email'=>'email','ppid'=>'email']);
            if(true != $result){
                return RDReturn('The mailbox format is incorrect, please retype');
            }
            $check = Db::name('member')->where('name',$email)->find();
            if($check){
                return RDReturn('The account has already existed, please reregister');
            }
            $data = [
                'name' => $email,
                'password' => $psd,
                'PayPal'=>$ppid,
                'PayPalTel'=>$pptel,
                'secretKey' => $key,
                'workStatus' => 1,
                'staffStatus' => 1,
                'createTime'  => date('Y-m-d H:i:s'),
            ];
            $save = Db::name('member')->insert($data);
            if($save){
                Session::set('IsRegister',$data);
                return RDReturn('success','1');
            }
        }else{
            return;
        }
    }

    /**
     * 授权
     * @return mixed
     */
    public function authorization()
    {
        dump(Session::get());
        if(Session::get('IsRegister') == null)
        {
            exit();
        }
        $fb = new Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.default_graph_version'),
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email','publish_actions','manage_pages','publish_pages']; // Optional permissions
        $host = $_SERVER['SERVER_NAME'];
        $loginUrl = $helper->getLoginUrl("http://.$host./member/login/fbcallback", $permissions);
        $this->assign('url', $loginUrl);
        return $this->fetch();
    }

    public function forgotPwd()
    {
        return $this->fetch();
    }

    public function checkEmail(Request $request)
    {
        if($request->isPost()){
            $email = $request->post('email');
            $find = Db::name('member')->where('name',$email)->find();
            if($find){

                return RDReturn('The system has sent a change of password mail to your mailbox, please click the mail link for password modification',1);
            }else{
                return RDReturn('The account does not exist','0');
            }
        }else{
            exit();
        }
    }

}