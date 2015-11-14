<?php
/**
 * 会员中心控制器
 */
class MemberControl extends CommonControl {
	/**
	 * 默认显示会员信息中心首页
	 */
	public function __construct() {
		$this->top_cate();
		$this->_left_info();
	}
	public function index() {
		

		/**
		 * 我的提问
		 */
		$uid = $this->_GET('uid', 'intval');
		$where = array('uid'=>$uid);
		$field = 'content,title,answer,time,asid,ask.cid';
		$ask = K('ask')->join('category')->where($where)->field($field)->order('time DESC')->limit(6)->select();
		$this->assign('ask', $ask);

		/**
		 * 我的回答
		 */
		$field = 'answer.content,title,ask.answer,answer.time,ask.asid,ask.cid';
		$answer = K('answerInfo')->field($field)->where($where)->order('time DESC')->limit(6)->select();
		$this->assign('answer', $answer);
		$this->display();
	}
	/**
	 * 我的提问
	 */
	public function my_ask() {

		$uid = $this->_GET('uid', 'intval');
		$field = 'content,title,ask.answer,asid,ask.cid';
		$where = array(
			'uid' => $uid,
			'solve' =>0
		);
		$db = M('ask');
		$kdb = K('ask')->join('category');

		$noSolvePage = new page($db->where($where)->count(), 4,5,2);
		$noSolve = $kdb->field($field)->where($where)->order('time DESC')->select($noSolvePage->limit());
		$this->assign('noSolve', $noSolve);
		$this->assign('noSolvePage', $noSolvePage->show());

		$whereOk = array(
			'uid' => $uid,
			'solve' =>1
		);
		
		$Solve = $kdb->field($field)->where($whereOk)->order('time DESC')->select();
		$this->assign('Solve', $Solve);
		
		$this->display();
	}
	/**
	 * 我的回答
	 */
	public function my_answer() {

		$uid = $this->_GET('uid', 'intval');
		$db = M('answer');
		$kdb = K('answerInfo');
		$where = array(
			'uid'=>$uid
		);
		$field = 'answer.content,title,ask.answer,answer.time,ask.asid,ask.cid';
		$page = new page($db->where($where)->count(), 4,5,2);
		$answer = $kdb->field($field)->where($where)->order('time DESC')->select($page->limit());

		$whereOk = array(
			'uid' => $uid,
			'accept' =>1
		);
		
		$answerOk = $kdb->field($field)->where($whereOk)->order('time DESC')->limit(10)->select();

		//p($answer);
	
		$this->assign('answerOk', $answerOk);
		$this->assign('page', $page->show());
		$this->assign('answer', $answer);
		$this->display();
	}
	/**
	 * 我的等级
	 */
	public function my_level() {

		$uid = $this->_GET('uid', 'intval');
		$user = M('user')->where(array('uid'=>$uid))->field('exp')->find();
		$level = $this->exp_to_level($user);

		//距离下次升级所需的经验值
		$nextExp = C('LV'.($level+1))-$user['exp'];
		$nextExp = $nextExp<0 ? 0 : $nextExp;

		$this->assign('level', $level);
		$this->assign('user', $user);
		$this->assign('nextExp', $nextExp);

		$levelExp = array();
		for ($i=0; $i<8; $i++) {
			$levelExp[$i] = C('LV'.$i);
		}

		$this->assign('levelExp', $levelExp);
		$this->display();
	}
	/**
	 * 我的金币
	 */
	public function my_gold() {
		
		$this->display();
	}
	/**
	 * 我的头像
	 */
	public function my_face() {
		/**
		 * 
		 */
		$uid = $this->_GET('uid', 'intval');
		$db = M('user');
		$where = array('uid'=>$uid);
		if (IS_POST) {
			$upload = new upload();
			$uploadInfo = $upload->upload();

			//将以前的图片的路径拿出来
			$oldFace = $db->where($where)->getField('face');
			//组合物理路基
			$oldFace = './'.substr($oldFace, strpos($oldFace, 'upload'));
			if (is_file($oldFace)) {
				if (!unlink($oldFace)) {
					error('没有权限上传头像');
				}
			}
			//插入现在的图片路径
			$face = __ROOT__.'/'.$uploadInfo[0]['path'];
			$user = $db->where($where)->save(array('face'=>$face));
			$this->success('上传成功');

		}
		$user = $db->where(array('uid'=>$uid))->field('face')->find();

	
		$this->assign('face',$this->face($user));
		$this->display();
	}
	/**
	 * 左侧用户信息
	 */
	private function _left_info() {

		$uid = $this->_GET('uid', 'intval');
		$field = 'face,username,point,exp,ask,answer,accept';
		$member = M('user')->where(array('uid'=>$uid))->field($field)->find();

		if (!empty($member)) {
			$member['face'] = $this->face($member);
			$member['ratio'] = $this->ratio($member);
			$member['lv'] = $this->exp_to_level($member);

			$this->assign('member', $member);
		} else {
			$this->error('用户不存在');
		}

		//第三人称
		$rank = isset($_SESSION['uid']) && $uid ==$_SESSION['uid'] ? '我' : 'TA';

		$this->assign('rank', $rank);

	}
	
}