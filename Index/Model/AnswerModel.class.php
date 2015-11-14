<?php
/**
 * 答案和用户户关联表
 */
class AnswerModel extends ViewModel {
	public $view = array(

		'user' => array(
			'type' => 'inner',
			'field'=>'username,exp,face,accept,ask,answer',
			'on' =>'answer.uid=user.uid'
		),

	);
}