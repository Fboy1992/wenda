<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo C("WEBNAME");?></title> 
	<meta name="keywords" content="<?php echo C("KEYWORDS");?>"/>
	<meta name="description" content="<?php echo C("DISCRIPTION");?>"/> 
	<link rel="stylesheet" href="http://localhost/wenda/Index/Tpl/Public/css/base.css" />
	<script src="http://localhost/wenda/Index/Tpl/Public/js/jquery.js"></script>
	<script src="http://localhost/wenda/Index/Tpl/Public/js/top_bar.js"></script>
	<script src="http://localhost/wenda/Index/Tpl/Public/js/validate.js"></script>
	<script>
	var APP = "http://localhost/wenda/index.php";
	</script>
	<script src="http://localhost/wenda/Index/Tpl/Public/js/member_answer.js"></script>
	<link rel="stylesheet" href="http://localhost/wenda/Index/Tpl/Public/css/member.css" />
</head>
<body>     
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><div id="top">         
	<p class="left">SF问答系统</p> 
	<div class="reg_log">
		<?php if(isset($_SESSION['username']) && isset($_SESSION['uid'])){?>
			<span class="userinfo"><a href="<?php echo U('Member/index', array('uid'=>$_SESSION['uid']));?>"><?php echo $_SESSION['username'];?></a></span>|
			<span class="exit"><a href="<?php echo U('Login/out');?>">退出</a></span>
		<?php  }else{ ?>
		    <span class="reg"><a href="javascript:;">注册</a></span>|
			<span class="log"><a href="javascript:;">登陆</a></span>
		<?php }?>     
	</div>     
</div>
<div id="reg" style="display:none">
	<h2>欢迎注册SF问答系统<span id="reg_close">[关闭]</span></h2>
	<div>账户注册</div>
	<form action="<?php echo U('Reg/register');?>" method="post" name="register">
		<p><span class="left">用户名:</span><span class="right"><input type="text" name="username" id=""></span><span class="commet">(2-14个字母，数字和字符)</span></p>
		<p><span class="left">密码:</span><span class="right"><input type="password" name="passwd" id=""></span><span class="commet">(6-20个字母，数字和字符)</span></p>
		<p><span class="left">确认密码:</span><span class="right"><input type="password" name="repasswd" id=""></span><span class="commet">(再次输入密码)</span></p>
		<p><span class="left">验证码:</span><span class="right"><input type="text" name="code" id="code"><img src="<?php echo U('Reg/code');?>" alt="验证码" class="verify-img"/></span><span class="commet">(输入验证码信息)</span></p>
		<p class="sub"><input type="submit" name="submit" value="立即注册" id=""></p>
		
	</form>
</div>
<div id="log" style="display:none">
	<h2>欢迎您登陆<span id="log_close">[关闭]</span></h2>
	<div>用户登陆</div>
	<form action="<?php echo U('Login/login');?>" method="post" name="login">
		<p><span class="left">用户名:</span><span class="right"><input type="text" name="username" id=""></span><span class="commet">(请填写用户名)</span></p>
		<p><span class="left">密码:</span><span class="right"><input type="password" name="passwd" id=""></span><span class="commet">(请填写用户密码)</span></p>
		<p><span class="left"><input type="radio" value="on" name="auto" id="auto"></span><span class="right">下次自动登陆</span></p>
		<p class="sub"><input type="submit" name="submit" value="登陆" id=""></p>
	</form>
</div>   
<div id="search">         
	<div class="logo">             
		<img src="http://localhost/wenda/Index/Tpl/Public/image/logo.png" alt="sf问答" />         
	</div>         
	<div class="box">
		<form action="<?php echo U('Search/search', array('asid'=>$n['asid'], 'cid'=>$n['cid']));?>" name="sch" method="post">             
			<input type="text" name="text" id="text" />             
			<input type="submit" id="sub" value="搜索答案"/>          
		</form>          
	</div>         
	<a href="<?php echo U('Ask/ask');?>" idd="ask"><button>？我要提问</button></a>     
</div>     
<div id="nav">         
	<ul class="list"> 
		<li class="nav_sel"><a href="<?php echo U('Index/index');?>" class="home">问答首页</a></li>             
		<li class="nav_sel ask_cate">
			<a href="#" class="ask_list">问题库</a>
			<ul class="hidden" style="display:none;">
				<?php if(isset($topCate) && !empty($topCate)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($topCate));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($topCate,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

				<li><a href="<?php echo U('List/index', array('cid'=>$n['cid']));?>"><?php echo $n['title'];?></a></li>
				<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
				
			</ul>
		</li> 
	</ul>
	<p>累计问答次数(<strong><?php echo $askNum;?></strong>)次</p>     
</div>
<div id='center'>
<!-- 左侧 -->
	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!-- 左侧 -->
	<div id='left'>
		<div class='userinfo'>
			<dl>
				<dt>
					<a href="<?php echo U('Member/index', array('uid'=>$_GET['uid']));?>"><img src="<?php echo $member['face'];?>" width='48' height='48' alt="我的头像"/></a>
				</dt>
				<dd class='username'>
					<a href="<?php echo U('Member/index', array('uid'=>$_SESSION['uid']));?>"><b><?php echo $member['username'];?></b>
					</a>
					<a href="">
						<i class='level lv1' title='Level <?php echo $member['lv'];?>'><?php echo $member['lv'];?></i>
					</a>
				</dd>
				<dd>金币：<b class='point'><?php echo $member['point'];?></b></dd>
				<dd>经验值：<?php echo $member['exp'];?></dd>
			</dl>
			<table>
				<tr>
					<td>回答数</td>
					<td>采纳率</td>
					<td class='last'>提问数</td>
				</tr>
				<tr>
					<td><?php echo $member['answer'];?></td>
					<td><?php echo $member['ratio'];?>%</td>
					<td class='last'><?php echo $member['ask'];?></td>
				</tr>
			</table>
		</div>
		<ul>
			<li class='myhome <?php if(METHOD == 'index'){?>cur<?php }?>'>
				<a href="<?php echo U('Member/index', array('uid'=>$_GET['uid']));?>">我的首页</a>
			</li>
			<li class='myask <?php if(METHOD == 'my_ask'){?>cur<?php }?>'>
				<a href="<?php echo U('Member/my_ask', array('uid'=>$_GET['uid']));?>">我的提问</a>
			</li>
			<li class='myanswer <?php if(METHOD == 'my_answer'){?>cur<?php }?>'>
				<a href="<?php echo U('Member/my_answer', array('uid'=>$_GET['uid']));?>">我的回答</a>
			</li>
			<li class='mylevel <?php if(METHOD == 'my_level'){?>cur<?php }?>'>
				<a href="<?php echo U('Member/my_level', array('uid'=>$_GET['uid']));?>">我的等级</a>
			</li>
			<li class='mygold <?php if(METHOD == 'my_gold'){?>cur<?php }?>'>
				<a href="<?php echo U('Member/my_gold', array('uid'=>$_GET['uid']));?>">我的金币</a>
			</li> 
			<li class='myface <?php if(METHOD == 'my_face'){?>cur<?php }?>'>
				<a href="<?php echo U('Member/my_face', array('uid'=>$_GET['uid']));?>">上传头像</a>
			</li>
		</ul>
	</div>
<!-- 左侧结束 -->
	<div id='right'>
			<p class='title'>我的金币</p>
			<p class='lv-info'>
				<?php if($member['point'] == 0){?>
					您还没有金币，赶紧向着高富帅去奋斗吧!
				<?php  }else{ ?>
					您现有金币<span style="color:orange;"><?php echo $member['point'];?></span>
				<?php }?>
			</p>
			<div class='lv-rule'>
				<p><span>金币获取</span></p>
				<table class='lv-exp'>
					<tr>
						<th>操作</th>
						<th>获得金币</th>
					</tr>
					<tr>
						<td>回答</td>
						<td>+<?php echo C('GOLD_ANSWER');?>金币</td>
					</tr>
					<tr>
						<td>回答被采纳</td>
						<td>+<?php echo C('GOLD_ACCEPT');?>金币</td>
					</tr>
					<tr>
						<td>回答被删除：</td>
						<td>-<?php echo C('GOLD_ANSWER_DELETE');?>金币</td>
					</tr>
					<tr>
						<td>提问被删除：</td>
						<td>-<?php echo C('GOLD_ASK_DELETE');?>金币</td>
					</tr>
					<tr>
						<td>采纳回答被删除</td>
						<td>提问者：-<?php echo C('GOLD_ASK_DELETE');?>金币&nbsp;&nbsp;回答者：-<?php echo C('GOLD_ANSWER_DELETE');?>金币</td>
					</tr>
				</table>
			</div>
		</div>
	
</div>
<!--------------------中部结束-------------------->
<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><div id="dream">
	<h3>每日一句---名人名言</h3>
	<p>
		<marquee>书是人类进步的阶梯____高尔基</marquee>
	</p>
</div>
<div id="bottom">
	<h3>版权所有</h3>
	<p>小二爱折腾工作室</p>
	<p class="copyright">地址：河北省保定市五四东路180号河北大学   邮编：071002   冀ICP备05007415号   保公备130603100019号</p>
</div>
</body>
</html>