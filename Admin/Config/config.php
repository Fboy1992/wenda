<?php
if (!defined("HDPHP_PATH"))exit('No direct script access allowed');
//更多配置请查看hdphp/Config/config.php
$arr = array(

	 /********************************验证码********************************/
    "CODE_FONT"                     => HDPHP_PATH . "Data/Font/font.ttf",       //字体
    "CODE_STR"                      => "123456789abcdefghijklmnpqrstuvwsyz", //验证码种子
    "CODE_WIDTH"                    => 80,         //宽度
    "CODE_HEIGHT"                   => 25,          //高度
    "CODE_BG_COLOR"                 => "#ffffff",   //背景颜色
    "CODE_LEN"                      => 4,           //文字数量
    "CODE_FONT_SIZE"                => 16,          //字体大小
    "CODE_FONT_COLOR"               => "",          //字体颜色

    "COOKIE_TIME"					=> time() + 3600*24*30, 			//默认cookie登陆时间是一个月
);
//这里的路径到底应该是什么？是./还是../../
return array_merge(include "./Conf/config.php", include "./Conf/webConfig.php", $arr);
?>