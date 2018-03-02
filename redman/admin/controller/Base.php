<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-6
 * Time: 下午4:27
 */
namespace app\admin\controller;

use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;

class Base extends Controller
{
    /**
     * Base constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }
    /**
     * 初始化
     * 登录验证
     */
    public function _initialize()
    {
        $session = Session::get('RD_STAFF');
//        dump(Session::get());
//        die();
        if (!$session) {
            // $this->redirect(url('admin/index/login'));
            Session::set('RD_STAFF',null);
            $this->error('登录超时，请重新登录', '/admin/login/index');
        };
    }

    /**
     * 设置语言
     */
    public function lang() {
        switch ($_GET['lang']) {
            case 'cn':

                \think\Cookie::clear('think_var');
                \think\Cookie::set('think_var','zh-cn');
                \think\Lang::detect();
                break;
            case 'en':
                \think\Lang::range('en-us');
                \think\Cookie::clear('think_var');
                \think\Cookie::set('think_var','en-us');
                \think\Lang::detect();
                break;
            //其它语言
        }
    }

    protected function fetch($template = '', $vars = [], $replace = [], $config = [])
    {
        $replace['__ADMIN__'] = str_replace('/index.php','',\think\Request::instance()->root()).'/admin/admin/view';
        return $this->view->fetch($template, $vars, $replace, $config);
    }
    /*
     * 获取验证码
     */
    public function getVerify(){
        RDVerify();
    }

    public function uploadPic(){
        return RDUploadPic(1);
    }

    /**
     * 编辑器上传文件
     */
    public function editorUpload(){
        return RDEditUpload(1);
    }
}