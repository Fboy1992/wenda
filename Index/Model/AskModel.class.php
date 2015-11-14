<?php
/*
*问题和用户关联模型
*问题表和用户表--->相关联(join的使用)
*笛卡尔积
*/
class AskModel extends ViewModel {
	/*
		暂时只和用户关联就好
	*/
	public $view = array(

		/**
		 * 关联用户表
		 */
		'user' => array(
			'type'=>'inner',
			'field'=>'username,exp',
			'on'=>'user.uid=ask.uid'
		),
		/**
		 * 关联分类表
		 */
		'category' => array(
			'type' => 'inner',
			'field' => 'title, cid',
			'on' => 'category.cid=ask.cid'
		),

	);
}