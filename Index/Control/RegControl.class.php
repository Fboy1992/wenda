<?php
/*
注册控制器
 */
class RegControl extends Control {
	/*
	异步检查用户名
	 */
	public function ajax_username() {
		/*
		IS_AJAX框架内部方法：异步为真，非异步为假,
		 */
		if (!IS_AJAX) {
			$this->error('页面不存在');
		}
		$username = $this->_POST('username');
		if (M('user')->where(array('username'=>$username))->getField('uid')) {
			//给js端的status使用
			echo 0;
		} else {
			echo 1;
		}
	}
	/*
	验证码
	 */
	public function code() {
		$code = new code();
		$code->show();
	}
	/*
	异步判断验证码
	 */
	public function ajax_code() {
		if (!IS_AJAX) {
			$this->error('页面不存在');
		}
		$code = $this->_POST('code','htmlspecialchars,strtoupper');
		if($code != $this->_SESSION('code')) {
			echo 0;
		} else {
			echo 1;
		}
	}
	/*
	注册用户
	 */
	public function register() {
		if (!C('RES_ON')) {
			$this->error('网站正在调整，还不能注册，给您带来不便，非常抱歉',"Index/index");
		}
		if (!IS_POST) {
			$this->error('页面不存在');
		}
		$data = array(
			'username'	=> $this->_POST('username'),
			'passwd' 	=> $this->_POST('passwd', 'md5'),
			'restime'	=> time()
		);
		//插入数据库
		if(M('user')->add($data)) {
			$this->success('添加用户成功');
		} else {
			$this->error('添加用户失败');
		}
	}
}