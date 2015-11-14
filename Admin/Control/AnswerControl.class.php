<?php
/**
 * 回答控制器
 */
class AnswerControl extends CommonControl {

	/**
	 * 答案提示
	 */
	public function answer() {

		$w = $this->_GET('w', 'intval');

		switch($w) {
			case 1:
				$where = array('accept'=>0);
				break;
			case 2:
				$where = array('accept'=>1);
				break;
			default:
				$where = null;
				break;
		}

		$db = M('answer');
		$count = $db->where($where)->count();

		$page = new page($count, 10,5,2);
		$field = 'anid,content,time';
		$answer = $db->where($where)->field($field)->select($page->limit());

		$this->assign('page', $page->show());
		$this->assign('count', $count);
		$this->assign('answer', $answer);

		$this->display();
	}
	/**
	 * 删除答案
	 */
	public function del_answer() {
		$anid = $this->_GET('anid', 'intval');
		$where = array('anid'=>$anid);

		$db = M('user');
		$answer = M('answer')->where($where)->field('uid,accept,asid')->find();
		$ansUid = $answer['uid'];

		//删除回答者金币
		$db->dec('point',"uid=$ansUid", C('GOLD_DEL_ANSWER'));

		if ($answer['accept']) {
			$askDb = M('ask');
			$where = array('asid'=>$answer['asid']);
			$askUid = $askDb->where($where)->getField('uid');

			//删除提问者的金币
			$db->dec('point', "uid=$askUid", C('GOLD_DEL_ANSWER'));
			//答案改为未解决
			$askDb->where($where)->save(array('solve'=>0));			
		}

		//删除答案
		M('answer')->where(array('anid'=>$anid))->delete();

		$this->success('答案删除成功');
	}
}