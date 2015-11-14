<?php
/**
 * 系统配置控制器
 */
class SystemControl extends CommonControl {

	/**
	 * 网站配置
	 */
	public function web_set() {
		$this->display();
	}
	/**
	 * 修改密码
	 */
	public function edit_pwd() {

		if(IS_POST) {
			$passwdF = $this->_POST('passwdF', 'trim,htmlspecialchars');
			$passwdS = $this->_POST('passwdS', 'trim,htmlspecialchars');
			if(strlen($passwdF) <6 ) {
				$this->error('密码不得小于6位');
			}
			if ($passwdS != $passwdF) {
				$this->error('两次密码不相同');
			}
			$aid = $this->_SESSION('aid', 'intval');
			M('admin')->where(array('aid'=>$aid))->save(array('passwd'=>md5($passwdF)));

			$this->success('修改成功');
		}
 
		$this->display();
	}
}