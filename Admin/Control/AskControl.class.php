<?php
/**
 * 问题管理控制器
 */
class AskControl extends CommonControl {

	/*
	问题提示
	*/
	public function ask() {

		$w = $this->_GET('w', 'intval');

		switch ($w) {
			case 1:
				$where = array('solve'=>0);
				break;
			case 2:
				$where = array('solve'=>1);
				break;
			case 3:
				$where = array('answer'=>0);
				break;
			default:
				$where = null;
				break;			
		}

		$db = M('ask');
		$count = $db->where($where)->count();
		$page = new page($count, 10, 4, 2);

		$field = 'asid,content,time,reward,answer';
		$ask = $db->where($where)->field($field)->select($page->limit());

		$this->assign('count', $count);
		$this->assign('page', $page->show());
		$this->assign('ask', $ask);
		$this->display();
	}
	public function del_ask() {
		$asid = $this->_GET('asid', 'intval');
		$where = array('asid'=>$asid);

		$db = M('user');

		//删除问题，提问者扣除金币
		$ask = M('ask')->where($where)->field('solve,uid')->find();
		$askUid = $ask['uid'];
		$db->dec('point', "uid=$askUid", C('GOLD_DEL_ASK'));

		//找到采纳者回答的id
		if ($ask['solve']) {
			$answerUid = M('answer')->where(array('asid'=>$asid, 'accept'=>1))->getField('uid');
			$db->dec('point', "uid=$answerUid", C('GOLD_DEL_ASK'));
		}

		//删除问题
		M('ask')->where($where)->delete();
		//删除所属答案
		M('answer')->where($where)->delete();

	}

}