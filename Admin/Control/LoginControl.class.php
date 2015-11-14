<?php
/**
 * 登陆控制器
 */
class LoginControl extends Control {

	/**
	 * 登陆页方法
	 */
	public function index() {

		$this->display();
	}
	/**
	 * 验证码
	 */
	public function code() {
		$code = new Code();
		$code->show();
	}
	/**
	 * 后台会员登陆
	 */
	public function login() {
		if (!IS_POST) $this->error('页面不存在');

		$username = $this->_POST('username');
		$db = M('admin');
		$user = $db->where(array('username'=>$username))->field('passwd,lock,aid')->find();

		//账户锁定功能
		if($user['lock'] == 1) $this->error('您的账户已经被锁定,请联系管理员');

		$passwd = $this->_POST('passwd', 'md5');

		if ($passwd != $user['passwd']) $this->error('用户或者密码错误');

		$code = $this->_POST('verify', 'htmlspecialchars,strtoupper');

		//p($code); p($_SESSION);die;
		if ($_SESSION['code'] != $code) {
			$this->error('验证码错误');
		}
		$data = array(
			'logintime'=>time(),
			'loginip'=>ip::getClientIp()
		);
		$db->where(array('username'=>$username))->save($data);
		
		session('adminname', $username);
		session('aid', $user['aid']);
		// p($user);
		// p($_SESSION);die;
		$this->success('登陆成功!,正在为您跳转...', 'Index/index');
	}
	/**
	 * 退出
	 */
	public function out() {
		session_unset();
		session_destroy();
		$this->success('退出成功');
	}
}