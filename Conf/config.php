<?php
if (!defined('HDPHP_PATH'))exit('No direct script access allowed');
return array(
    //数据库
     /********************************数据库********************************/
    "DB_DRIVER"                     => "mysqli",    //数据库驱动
    "DB_HOST"                       => "127.0.0.1", //数据库连接主机  如127.0.0.1
    "DB_PORT"                       => 3306,        //数据库连接端口
    "DB_USER"                       => "root",      //数据库用户名
    "DB_PASSWORD"                   => "aishifeng123",          //数据库密码
    "DB_DATABASE"                   => "wenda",          //数据库名称
    "DB_PREFIX"                     => "sf_",          //表前缀
    "DB_FIELD_CACHE"                => 1,           //字段缓存
    "DB_BACKUP"                     => ROOT_PATH . "backup/".time(), //数据库备份目录
   
    /********************************验证码********************************/
    "CODE_FONT"                     => HDPHP_PATH . "Data/Font/font.ttf",       //字体
    "CODE_STR"                      => "123456789abcdefghijklmnpqrstuvwsyz", //验证码种子
    "CODE_WIDTH"                    => 80,         //宽度
    "CODE_HEIGHT"                   => 25,          //高度
    "CODE_BG_COLOR"                 => "#ffffff",   //背景颜色
    "CODE_LEN"                      => 4,           //文字数量
    "CODE_FONT_SIZE"                => 16,          //字体大小
    "CODE_FONT_COLOR"               => "",          //字体颜色
    /********************************分页处理********************************/
    "PAGE_VAR"                      => "page",      //分页GET变量
    "PAGE_ROW"                      => 10,          //页码数量
    "PAGE_SHOW_ROW"                 => 10,          //每页显示条数
    "PAGE_STYLE"                    => 2,           //页码风格
    "PAGE_DESC"                     => array("pre" => "上一页", "next" => "下一页",//分页文字设置
                                            "first" => "首页", "end" => "尾页", "unit" => "条"),
    



);
?>