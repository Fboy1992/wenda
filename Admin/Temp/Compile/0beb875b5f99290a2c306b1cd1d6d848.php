<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" href="http://localhost/wenda/Admin/Tpl/Public/Css/public.css" />
	<script type="text/javascript" src="http://localhost/wenda/Admin/Tpl/Public/Js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="http://localhost/wenda/Admin/Tpl/Public/Js/public.js"></script>
	<script type="text/javascript" src="http://localhost/wenda/Admin/Tpl/Public/Js/category.js"></script>
</head>

<body>
	<table class="table">
		<tr pid="0">
			<td class="th" colspan="20">分类列表</td>
		</tr>
		<tr class="tableTop" pid="0">
			<td class="tdLittle0 center">展开</td>
			<td class="tdLittle1">ID</td>
			<td>分类名称</td>
			<td class="tdLtitle7">操作</td>
		</tr>
		<?php if(isset($cate) && !empty($cate)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($cate));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($cate,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

		<tr pid="<?php echo $n['pid'];?>" cid="<?php echo $n['cid'];?>">
			<td><a href="javascript:void(0)" class="showPlus"></a></td>
			<td><?php echo $n['cid'];?></td>
			<td><?php echo $n['html'];?><?php echo $n['title'];?></td>
			
			<td>
				[<a href="<?php echo U('Category/add_cate', array('cid'=>$n['cid']));?>">添加子分类</a>][
				<a href="<?php echo U('Category/edit_cate', array('cid'=>$n['cid']));?>">修改</a>][
				<a href="<?php echo U('Category/del_cate', array('cid'=>$n['cid']));?>" class="del">删除</a>]
			</td>
		</tr>
		<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
		
	</table>

</body>
</html>