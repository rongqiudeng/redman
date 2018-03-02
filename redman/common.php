<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-6
 * Time: 下午4:23
 */
/***************************************************************************/
/*********************************admin部分公共函数***************************/
/***************************************************************************/
use think\Lang;
//设置包含语言的种类
Lang::setAllowLangList(['zh-cn','en-us']);
\think\Lang::detect();
//获取当前语言类型
function getNowLang()
{
    $lang = Lang::range();
    return $lang;
}

/*
* 核对验证码
*/
function RDAdminVerifyCheck($code){
    $verify = new \think\captcha\Captcha();
    return $verify->check($code);
}

/**
 * 获取当前用户id
 * @return mixed
 */
function getUserId()
{
    $res = \think\Session::get('RD_STAFF.loginName');
    return $res;
}

/**
 * 获取管理员级别
 * @return mixed
 */
function getStaffRoleId()
{
    $res = \think\Session::get('RD_STAFF.staffRoleId');
    return $res;
}



/***************************************************************************/
/*********************************member部分公共函数***************************/
/***************************************************************************/

/**
 * 获取当前会员名称
 * @return mixed
 */
function getMemberName()
{
    $man =  \think\Session::get('RD_PASS.name');
    return $man;
}

/**
 * 获取会员的Uid
 * @return mixed
 */
function getMemberUid()
{
    $uid = \think\Session::get('RD_PASS.uid');
    return $uid;
}

/***************************************************************************/
/*********************************所有部分公共函数***************************/
/***************************************************************************/
/**
 * 清除验证码缓存
 */
function RDVerify(){
    ob_clean(); //清空（擦掉）输出缓冲区
    $Verify = new \think\captcha\Captcha();
    $Verify->length   = 4;
    $Verify->entry();
}
/**
 * 核对验证码
 */
function RDVerifyCheck($code){
    $verify = new \think\captcha\Captcha();
    return $verify->check($code);
}
/**
 * 生成数据返回值
 */
function RDReturn($msg,$status = -1,$data = []){
    $rs = ['status'=>$status,'msg'=>$msg];
    if(!empty($data))$rs['data'] = $data;
    return $rs;
}

