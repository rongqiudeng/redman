<?php
/**
 * Created by PhpStorm.
 * User: rong
 * Date: 17-11-6
 * Time: 下午4:18
 */
return [
    // 默认模块名
    'default_module'         => 'admin',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Login',
    // 默认操作名
    'default_action'         => 'index',
    //设置模板展示路径
    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => 'theme/admin/',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],
    //admin角色设置
    'admin_role' =>[
      '0' =>'菜鸟管理员',
      '1' =>'系统管理员',
      '2' =>'新闻管理员',
      '3' =>'超级管理员',
      '4' =>'其他管理员',
      '5' =>'普通管理员',
    ],
    //card_status
    'card_status' =>[
        '0' => '未启用',
        '1' => '已启用',
        '2' => '已下架',
    ],
    //card_type
    'card_type' =>[
      '1' => '手动添加',
      '2' => '自动添加',
    ],
    //product_status
    'product_status' =>[
        '0' => '未导入',
        '1' => '已导入',
    ]
];