<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-29
 * Time: 下午4:23
 */
namespace app\member\model;

use think\Session;
use Facebook\Facebook;
class Fbuser extends Base
{
    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function doFbLogin()
    {
        $fb = new Facebook([
            'app_id' => '191418841417632',
            'app_secret' => '5abef6e0d704b49b240bff27178a99f2',
            'default_graph_version' => 'v2.10',
            //'persistent_data_handler' => new Fbapi(),
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
        //add session
        Session::set('fb_access_token', $userInfo);
        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: https://example.com/members.php');
        $res = $this->save($userInfo);
        if ($res) {
            Header("HTTP/1.1 303 See Other");
            Header("Location: /member/user/");
            exit;
        } else {
            Header("HTTP/1.1 303 See Other");
            Header("Location: /member/user/");
            exit;
        }
    }


}