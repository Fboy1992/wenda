<?php
/*
后台默认控制器
 */
class IndexControl extends CommonControl{
    /**
     * 后台默认显示
     */
    public function index(){
       
      $this->display();
    }
    /**
     * 右侧显示系统信息
     */
    public function copy() {
    	$aid = $this->_SESSION('aid', 'intval');

        
    	$admin = M('admin')->where(array('aid'=>$aid))->field('logintime,loginip')->find();

    	$this->assign('admin', $admin);
    	$this->display();
    }
}