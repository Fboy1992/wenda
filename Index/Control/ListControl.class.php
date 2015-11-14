<?php
/**
 * 列表控制器
 */
class ListControl extends CommonControl {

	/**
	 * 默认控制器
	 */
	public function index() {
		$this->assign_data();
		

		$cid = $this->_GET('cid', 'intval');
		$db = M('category');

		$fatherCate = $this->father_cate($db->select(), $cid);
		$this->assign('fatherCate', array_reverse($fatherCate));

		$sonCate = $db->where(array('pid'=>$cid))->select();

		/**
		 *对子集进行判断
		 */
		if (empty($sonCate)) {
			$pid = $db->where(array('cid'=>$cid))->getField('pid');
			$cid = $pid;
		}
		$sonCate = $db->where(array('pid'=>$cid))->select();
		$this->assign('sonCate', $sonCate);

		$where = $this->_GET('where');
		if (isset($where) && $where < 4) {
			$condition = $where;
		} else {
			$condition = 0;
		}
		switch ($condition) {
			case 0:
				$where = array('solve'=>0, 'reward'=>array('elt'=>20));
				break;
			case 1:
				$where = array('solve'=>1);
				break;
			case 2:
				$where = array('solve'=>0, 'reward'=>array('gt'=>20));
				break;
			case 3:
				$where = array('solve'=>0, 'answer'=>0);
		}
		if ($cid != 0) {
			$where['cid'] = $cid;
		}
		//p($where);
		
		//1
		$count = M('ask')->where($where)->count();
		//2
		$page = new page($count, 4,5,2);
		//3
		$this->assign('page', $page->show());

		$field = 'reward,content,answer,time,title,asid,ask.cid';//字段之间不可以有空格
		$ask = K('ask')->join('category')->where($where)->field($field)->select($page->limit());//4
		$this->assign('ask', $ask);


 		$this->display();
	}
}