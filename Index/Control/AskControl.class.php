<?php
/*
提问控制器
 */
class AskControl extends CommonControl {
	/*
	提问
	 */
	public function ask() {
		/*
		导航栏分类
		 */
		$this->top_cate();
		//获取金币
		$uid = $this->_SESSION('uid', 'intval');
		$point = M('user')->where(array('uid'=>$uid))->getField('point');
		$this->assign('point', $point);
		$this->display();
	}
	/*
	用户提问
	 */
	public function sub_ask() {
		if (!IS_POST) {
			$this->error('页面不存在');
		}
		$uid = $this->_SESSION('uid', 'intval');
		$reward = $this->_POST('reward', 'intval');

		$data = array(
			'content' => $this->_POST('content'),
			'time'	  => time(),
			//悬赏金币数
			'reward'  => $this->_POST('reward', 'intval'),
			'uid'     => $this->_SESSION('uid', 'intval'),
			'cid'	  => $this->_POST('cid')
			);
		M('ask')->add($data);

		$db = M('user');
		//减少响应的金币数
		$db->dec('point', "uid=$uid", $reward);
		$db->inc('ask', "uid=$uid", 1);
		$db->inc('exp', "uid=$uid", C('LV_ASK'));

		$this->success('提问成功', 'Index/index');

	}
	/*
	异步调取子分类
	 */
	public function get_cate() {
		if (!IS_AJAX) {
			$this->error('页面不存在');
		}
		$pid = $this->_POST('pid', 'intval');
		$cate = M('category')->where(array('pid'=>$pid))->select();

		if ($cate) {
			echo json_encode($cate);
		} else {
			echo 0;
		}

	}
}