<?php
/*
默认前台控制器
 */
class IndexControl extends CommonControl{
	/*
	默认前台显示方法
	 */
    function index(){

        $this->assign_data();
    	//拿出最高级
    	$cate = M('category')->where(array('pid'=>0))->select();

    	foreach ($cate as $k=>$v) {
    		$cate[$k]['down'] = M('category')->where(array('pid'=>$v['cid']))->select();
    	}
    	//通过这样分配，模版中才能有这个变量
    	$this->assign('cate', $cate);
    	

        //未解决，高悬赏
        $where = array(
            'solve'=>0,//表示未解决
            'reward' => array('elt'=>20)//低悬赏
            );
        $field = 'reward,content,answer,asid,cid';
        $askDb = M('ask');

        $noSolveL = $askDb->where($where)->order('time DESC')->field($field)->limit(5)->select();

        $this->assign('noSolveL', $noSolveL);

        //高分悬赏
        $where['reward'] = array('gt'=>20);
        $noSolveH = $askDb->where($where)->order('time DESC')->field($field)->limit(5)->select();

        $this->assign('noSolveH', $noSolveH);







    	$this->display();    
    }
    
}
?>