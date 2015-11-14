<?php
/**
 * 搜索控制器
 */
class SearchControl extends CommonControl {

	public function search() {
		$this->top_cate();

		if($_POST['text'] != '') {
			$text = $this->_POST('text');

				
			$field = 'ask.content,answer.content|ansContent,title,ask.answer,ask.time,ask.asid,ask.cid';
			$where = array(
				'accept'=>1,
				"ask.content like '%$text%'"
			);
			$search = K('AnswerInfo')->where($where)->field($field)->select();
			
			
		} 
		$this->assign('search', $search);
		$this->display();
	} 
}