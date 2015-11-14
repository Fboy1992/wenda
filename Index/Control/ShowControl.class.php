<?php
/*
问题操作控制器
 */
class ShowControl extends CommonControl {
	/*
	问题显示
	 */
	public function show() {
		 $this->assign_data();
		/*
		分配top
		 */
		$this->top_cate();
		$cid = $this->_GET('cid', 'intval');
		$cate = M('category')->select();

		//获得父级分类
		$father = $this->father_cate($cate, $cid);
		$this->assign('fatherCate', array_reverse($father));

		//知道哪个问题？
		$asid = $this->_GET('asid', 'intval');
		//赋予一个变量，K('ask')表示将两表进行关联了
		$ask = K('ask')->where(array('asid'=>$asid))->find();

		$this->assign('ask', $ask);
		$this->assign('lv', $this->exp_to_level($ask));

		//显示当前问题答案
		$answerDb = K('answer');
		$count  = $answerDb->where(array('asid'=>$asid))->count();
		$page = new page($count, 2,5,2);
		$answer = $answerDb->where(array('asid'=>$asid, 'accept'=>0))->select($page->limit());
		/**
		 * 多表关联，增删改查
		 */
		$this->assign('face', $this->face($answer));
		//分配page
		$this->assign('page', $page->show());
		$this->assign('count', $count);
		$this->assign('answer', $answer);

		/**
		 * 满意回答
		 */
		$where = array(
			'asid'=>$asid,
			'accept'=>1
		);
		$answerOk = K('answer')->where($where)->find();

		$this->assign('answerOk', $answerOk);
		$this->assign('ratio', $this->ratio($answerOk));
		$this->assign('faceok', $this->face($answerOk));
		$this->assign('answerOk_lv', $this->exp_to_level($answerOk));
		$this->display();
	}
	/**
	 * 回答问题内容提交
	 */
	public function answer() {
		if(!IS_POST) {
			$this->error('页面不存在');
		}

		$uid = $this->_SESSION('uid', 'intval');
		$asid = $this->_POST('asid', 'intval');
		//组合数据
		$data = array(

			'asid' => $this->_POST('asid', 'intval'),
			'uid'  => $this->_SESSION('uid', 'intval'),
			'time' => time(),
			'content' => $this->_POST('content')
		);
		M('answer')->add($data);
		//修改用户信息(金币，经验，回答数)
		$userDb = M('user');
		// 增加金币数
		$userDb->inc('point',"uid=$uid", C('GOLD_ANSWER'));
		//增加回答数
		$userDb->inc('answer', "uid=$uid", 1);
		//增加经验数
		$userDb->inc('exp', "uid=$uid", C('LV_ANSWER'));

		//问题表的回答数
		M('ask')->inc('answer', "asid=$asid", 1);

		$this->success('回答成功');

	}
	/**
	 * 问题采纳
	 */
	public function accept() {
		//修改采纳答案
		$anid = $this->_GET('anid', 'intval');
		M('answer')->where(array('anid'=>$anid))->save(array('accept'=>1));
		
		//问题标记为已解决
		$asid = $this->_GET('asid', 'intval');
		M('ask')->where(array('asid'=>$asid))->save(array('solve'=>1));

		//修改提问用户的信息
		$askUid = M('ask')->where(array('asid'=>$asid))->getField('uid');
		$userDb = M('user');

		$userDb->inc('point', "uid=$askUid", C('GOLD_ACCEPT'));
		$userDb->inc('exp', "uid=$askUid", C('LV_ACCEPT'));

		//修改回答用户信息
		$reward = M('ask')->where(array("asid"=>$asid))->getField('reward');
		$anUid = M('answer')->where(array('anid'=>$anid))->getField('uid');
		$userDb->inc('point', "uid=$anUid", C('GOLD_ACCEPT'));	//这里逻辑不对
		$userDb->inc('exp', "uid=$anUid", C('LV_ACCEPT'));
		$userDb->inc('accept', "uid=$anUid", 1);
		$userDb->inc('point', "uid=$anUid", $reward);

		$this->success('采纳成功');
		
	}
}