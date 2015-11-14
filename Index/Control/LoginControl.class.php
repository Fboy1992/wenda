<?php
/*
登陆控制器
 */
class LoginControl extends Control {
	/*
	ajax异步登陆验证
	 */
	public function ajax_login() {
		if (!IS_AJAX) {
			$this->error('页面不存在');
		}
		//ajax送来的用户名
		$username = $this->_POST('username');
		//ajax送过来的密码
		$pwd = $this->_POST('pwd', 'md5');
		//数据库查询用户名得到密码
		$passwd = M('user')->where(array('username'=>$username))->getField('passwd');

		if ($pwd != $passwd) {
			echo 0;
		} else {
			echo 1;
		}

	}
	
	/*
	登陆
	 */
	public function login() {
		if (!IS_POST) {
			$this->errror('页面不存在');
		}
		//进行后台验证
		$username = $this->_POST('username');
		$pwd = $this->_POST('passwd','md5');
		//数据库取出信息
		$user = M('user')->where(array('username'=>$username))->field('passwd,lock,uid')->find();
		if (empty($user)) {
			$this->error('用户不存在');
		}
		if ($pwd != $user['passwd']) {
			$this->error('用户名或者密码错误');
		}
		if ($user['lock'] == 1) {
			$this->error('您的账户已经被锁定，请联系管理员');
		}
		//增加登陆经验值
		$this->eve_exp($user['uid']);
		//登陆时间
		$loginData = array(
			'logintime' => time(),
			'loginip'	=> ip::getClientIp(),

		);
		//修改登陆时间和ip
		M('user')->where(array('uid'=>$user['uid']))->save($loginData);
		//自动登陆
		//p($_POST);
		$auto = $this->_POST('auto');
		if ($auto == 'on') {
			setcookie(session_name(), session_id(), C('COOKIE_TIME'), '/');
		}
		
		
		//session 框架自带方法
		session('username', $username);
		session('uid', $user['uid']);

		

		$this->success('登陆成功！正在跳转...', U('Index/index'));
	}
	/*
	每天登陆增加经验
	 */
	private function eve_exp($uid) {
		//获取当天时间戳
		$zero = strtotime(date('Y-m-d'));
		//获取用户登陆时间
		$logintime = M('user')->where(array('uid'=>$uid))->getField('logintime');

		//时间对比,这个点很重要呢
		if ($logintime < $zero) {
			M('user')->inc('exp', "uid=$uid", C('LV_LOGIN'));
		}
	}
	/**
	* 退出
	*
	*/
	public function out() {
		session_unset();
		session_destroy();
		$this->success('恭喜你退出成功','Index/index');
	}
}