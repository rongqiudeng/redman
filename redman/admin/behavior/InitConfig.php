<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-6
 * Time: 下午6:59
 */
class InitConfig
{
    public function run(&$params){
        RDConf('listenUrl',WSTVisitPrivilege());
        RDConf('CONF',WSTConfig());
    }
}