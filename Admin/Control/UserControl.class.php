<?php
/**
 * 后台对前台管理控制器
 */
class UserControl extends CommonControl {

	/**
	 * 显示模版
	 */
	public function index() {

		$user = M('user')->select();
		$this->assign('user', $user);
		$this->display();
	}
	/**
	 * 锁定用户
	 */
	public function lock_user() {
		$uid = $this->_GET('uid', 'intval');

		M('user')->where(array('uid'=>$uid))->save(array('lock'=>1));
		$this->success('锁定成功');
	}
	/**
	 * 解锁
	 */
	public function deblocking() {
		$uid = $this->_GET('uid', 'intval');

		M('user')->where(array('uid'=>$uid))->save(array('lock'=>0));
		$this->success('解锁成功');
	}
}