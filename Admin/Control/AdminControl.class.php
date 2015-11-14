<?php
/**
 * 后台用户管理
 */
class AdminControl extends CommonControl {

	/**
	 * 用户列表方法
	 */
	public function  index() {

		$field = 'aid,username,logintime,loginip,lock';
		$this->assign('admin', M('admin')->field($field)->select());

		$this->display();
	}
	/**
	 * 锁定用户
	 */
	public function lock() {
		$aid = $this->_GET('aid', 'intval');
		M('admin')->where(array('aid'=>$aid))->save(array('lock'=>1));
		$this->success('锁定成功');
	}
	/**
	 * 解锁用户
	 */
	public function unlock() {
		$aid = $this->_GET('aid', 'intval');
		M('admin')->where(array('aid'=>$aid))->save(array('lock'=>0));
		$this->success('解锁成功');
	}
	/**
	 * 添加用户
	 */
	public function add() {
		if(IS_POST) {
			$username = $this->_POST('username');
			$passwdF = $this->_POST('passwdF', 'trim,htmlspecialchars');
			$passwdS = $this->_POST('passwdS', 'trim,htmlspecialchars');
			if(strlen($passwdF) <6 ) {
				$this->error('密码不得小于6位');
			}
			if ($passwdS != $passwdF) {
				$this->error('两次密码不相同');
			}

			$stat = M('admin')->where(array('username'=>$username))->getField('aid');
			if ($stat) {
				$this->error('用户名已近存在，请更换用户名');
			}

			$data = array(
				'username'=>$username,
				'passwd'=>MD5($passwdF)
			);
			M('admin')->add($data);
			$this->success('添加用户成功');
		}

		$this->display();
	}


}