<?php
/*
公共控制器
 */
class CommonControl extends Control {
	/**
	 * 
	 */
	public function __init() {
		if (!C('WEB_ON')) die('网站正在调整，已经关闭');
	}

	public function assign_data() {
		$this->top_cate();
		$this->right_info();
        $this->eve_star();
        $this->his_star();
        $this->helper();
	}
	/*
	顶级分类
	 */
	public function top_cate() {
		//顶级分类
		$topCate = M('category')->where(array('pid'=>0))->select();
		$this->assign('topCate', $topCate);

		//累计提问
		$askNum = M('ask')->count();
		$this->assign('askNum', $askNum);
	}

	/*
	获得父级分类，无限极分类
	*
	*/
	/*
		名字	cid 	pid
		电脑	1		0
		硬件	2		1
		内存	3  		2
	 */
	public function father_cate($arr, $pid) {
		$array = array();

		foreach ($arr as $v) {
			if ($v['cid'] == $pid) {
				$array[] = $v;
				//现将硬件放进了,再将电脑放进来
				$array = array_merge($array, $this->father_cate($arr, $v['pid']));
			}
		}
		return $array;
	}
	/**
	 * 经验等级转换方法
	 * param arr $user 用户数据数组
	 */
	public function exp_to_level($user) {
		$exp = $user['exp'];

		for ($i=0; $i<21; $i++) {
			//经验小于指定级数的检验值,
			if ($exp <= C('LV'.$i)) {
				return $i;
			}
		}
		//经验大于20级时
		if ($exp > C('LV20')) {
			return 20;
		}
	}
	/**
	 * 头像处理
	 * @param arr $user 用户数据
	 */
	public function face($user) {
		if (!empty($user['face'])) {
			return $user['face'];
		}
		return __PUBLIC__.'/image/noface.gif';
	}
	/**
	 * 采纳率换算
	 * @param arr $user 接受用户表数据
	 */
	public function ratio($user) {
		if (!empty($user) && $user['answer']) {
			$num = $user['accept'] / $user['answer'];

			$ratio =(sprintf("%.2f",$num)) * 100;
		} else {
			$ratio = 0;
		}
		return $ratio;

	}
	/**
	 * 右侧用户信息
	 */
	public function right_info() {
		$uid = $this->_SESSION('uid', 'intval');

		//存在uid,则取出信息
		if ($uid) {
			$field = 'face,exp,point,answer,ask,accept';
			$userInfo = M('user')->where(array('uid'=>$uid))->field()->find();

			//获取头像
			$userInfo['face'] = $this->face($userInfo);
			//获取等级
			$userInfo['lv'] = $this->exp_to_level($userInfo);
			//采纳率
			$userInfo['ratio'] = $this->ratio($userInfo);

			
			$this->assign('userInfo', $userInfo);
		}
	}
	/**
	 * 本日回答最多之人
	 */
	public function eve_star() {
		//获取0点时间戳，得到今日
		$zero = strtotime(date('Y-m-d'));
		//想要获取的字段
		$field = 'face,username,user.uid,exp,answer,user.accept';
		/*
		where条件限制在今日，group按姓名分组，count(username)最大的排在第一的位置,得到想要的结果
		 */
		$eve_star = K('answer')->where(array('time'=>array('gt'=>$zero)))->field($field)->group('username')->order('COUNT(username) DESC')->find();
		if (!empty($eve_star)) {
			//获取头像
			$eve_star['face'] = $this->face($eve_star);
			//获取等级
			$eve_star['lv'] = $this->exp_to_level($eve_star);
			//采纳率
			$eve_star['ratio'] = $this->ratio($eve_star);
		}
		$this->assign('eve_star', $eve_star);
	}
	/**
	 * 历史回答最多的人
	 */
	public function his_star() {
		$field = 'face,username,user.uid,exp,answer,user.accept';
		
		$his_star = K('answer')->field($field)->order('answer DESC')->find();

		if (!empty($his_star)) {
			//获取头像
			$his_star['face'] = $this->face($his_star);
			//获取等级
			$his_star['lv'] = $this->exp_to_level($his_star);
			//采纳率
			$his_star['ratio'] = $this->ratio($his_star);
		}
		//p($his_star);
		$this->assign('his_star', $his_star);
	}
	/**
	 * 助人光荣榜
	 */
	public function helper() {
		$field = 'uid,username,accept';

		$helper = M('user')->field($field)->order('accept DESC')->limit(10)->select();
		//p($helper);
		$this->assign('helper', $helper);
	}
	/**
	 * 搜索功能
	 */
}