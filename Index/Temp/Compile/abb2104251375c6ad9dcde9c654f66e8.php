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
	<link rel="stylesheet" href="http://localhost/wenda/Index/Tpl/Public/css/index.css" />
	<script src="http://localhost/wenda/Index/Tpl/Public/js/index.js"></script>
	
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
	<div id="cont"> 
		<!-- 左侧导航开始 -->         
		<div id="sub_nav"> 
			<h2>所有问题分类</h2> 
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
      
			<dl class="c">
				<dt><a href="<?php echo U('List/index', array('cid'=>$n['cid']));?>"><?php echo $n['title'];?></a></dt>
				<dd>
				<?php if(isset($n['down']) && !empty($n['down'])):$_id_v=0;$_index_v=0;$lastv=min(2,count($n['down']));
$hd["list"]["v"]["first"]=true;
$hd["list"]["v"]["last"]=false;
$_total_v=ceil($lastv/1);$hd["list"]["v"]["total"]=$_total_v;
$_data_v = array_slice($n['down'],0,$lastv);
if(count($_data_v)==0):echo "";
else:
foreach($_data_v as $key=>$v):
if(($_id_v)%1==0):$_id_v++;else:$_id_v++;continue;endif;
$hd["list"]["v"]["index"]=++$_index_v;
if($_index_v>=$_total_v):$hd["list"]["v"]["last"]=true;endif;?>

					<span><a href="<?php echo U('List/index', array('cid'=>$v['cid']));?>"><?php echo $v['title'];?></a></span>
				<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
				</dd> 
				<ul class="c_ul"> 
					<?php if(isset($n['down']) && !empty($n['down'])):$_id_v=0;$_index_v=0;$lastv=min(1000,count($n['down']));
$hd["list"]["v"]["first"]=true;
$hd["list"]["v"]["last"]=false;
$_total_v=ceil($lastv/1);$hd["list"]["v"]["total"]=$_total_v;
$_data_v = array_slice($n['down'],2,$lastv);
if(count($_data_v)==0):echo "";
else:
foreach($_data_v as $key=>$v):
if(($_id_v)%1==0):$_id_v++;else:$_id_v++;continue;endif;
$hd["list"]["v"]["index"]=++$_index_v;
if($_index_v>=$_total_v):$hd["list"]["v"]["last"]=true;endif;?>

						<li><a href="<?php echo U('List/index', array('cid'=>$v['cid']));?>"><?php echo $v['title'];?></a></li>
					<?php $hd["list"]["v"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>                    	                 
				</ul>             
			</dl>
			<?php $hd["list"]["v"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
		</div>
		<!-- 左侧导航结束 -->         
		<!-- 中部区域开始 --> 
		<div id="center"> 
			<!--轮播版开始 -->             
			<div class="tab"> 
				<div class="img">
					<p>
					<img src="http://localhost/wenda/Index/Tpl/Public/image/1.jpg" alt="" /><img src="http://localhost/wenda/Index/Tpl/Public/image/2.jpg" alt="" /><img src="http://localhost/wenda/Index/Tpl/Public/image/3.jpg" alt="" />
					</p>
				</div>                 
			<ul class='tab_ul'>
				<li><a href="#">快乐问答</a></li> 
				<li><a href="#">一问一答</a></li> 
				<li><a href="#">知行合一</a></li> 
			</ul>             
			</div> 
			<!-- 轮播版结束 --> 
			<!-- 问题开始 -->
			<div class="ask"> 
				<p class="title">                     
					<span style="background:#24ad41;">待解决问题 </span>
					<span>高分悬赏问题</span><a href="<?php echo U('List/index', array('cid'=>0));?>">more>></a>                 
				</p> 
				<div class="detail"> 
					<ul> 
						<?php if(isset($noSolveL) && !empty($noSolveL)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($noSolveL));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($noSolveL,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>
 
							<!-- 这里的asid不能用点的方法，必须原生 -->
							<li><a href="<?php echo U('Show/show', array('asid'=>$n['asid'], 'cid'=>$n['cid']));?>"><?php echo $n['content'];?></a><span><?php echo $n['answer'];?>回答</span></li> 
						<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
					</ul>
					<ul style="display:none;">
						<?php if(isset($noSolveH) && !empty($noSolveH)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($noSolveH));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($noSolveH,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

							<li><b style="color:orange;">金币:<?php echo $n['reward'];?></b><a href="<?php echo U('Show/show', array('asid'=>$n['asid'], 'cid'=>$n['cid']));?>"><?php echo $n['content'];?></a><span><?php echo $n['answer'];?>回答</span></li>
						<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
					</ul>
				</div>
			</div>
			<!-- 问题结束 -->
		</div>
		<!-- 中部区域结束 -->
		<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!-- 右侧区域开始 -->
<div id="right">
	<div class="top">
		<h3>用户管理中心</h3>
		<?php if(isset($_SESSION['username']) && isset($_SESSION['uid'])){?>
		<dl class="user">
			<dt><a href="<?php echo U('Member/index', array('uid'=>$_SESSION['uid']));?>"><?php echo $_SESSION['username'];?></a></dt>
			<dd><img src="http://localhost/wenda/Index/Tpl/Public/image/user_main.png" alt="1234" /></dd>
			<dd>金币：<em><?php echo $userInfo['point'];?></em></dd>
			<dd>经验值：<em><?php echo $userInfo['exp'];?></em></dd>
		</dl>
		<div class="relate">
			<span>回答数<em><?php echo $userInfo['answer'];?></em></span>
			<span>采纳率<em><?php echo $userInfo['ratio'];?>%</em></span>
			<span>提问数<em><?php echo $userInfo['ask'];?></em></span>
		</div>

		<div class="rel_ask">
			<a href="<?php echo U('Member/my_ask', array('uid'=>$_SESSION['uid']));?>"><em><img src="http://localhost/wenda/Index/Tpl/Public/image/ask.png" alt="" /></em><span>我提问的</span></a>
			<a href="<?php echo U('Member/my_answer', array('uid'=>$_SESSION['uid']));?>"><em><img src="http://localhost/wenda/Index/Tpl/Public/image/answer.png" alt="" /></em><span>我回答的</span></a>
		</div>
		<?php  }else{ ?>
			<div class="r_login">
				<span><a href="#">本区域登陆可见</a></span>
			</div>
		<?php }?>
	</div>
	<div class="bot">
		<h3>SF问答之星</h3>
		<dl class="one">
			<dt>本日回答问题最多之人</dt>
			<?php if(!empty($eve_star)){?>
				<dd><?php echo $eve_star['username'];?></dd>
				<dd><img src="http://localhost/wenda/Index/Tpl/Public/image/user.png" alt="fds" /></dd>
				<dd>回答数:<em><?php echo $eve_star['answer'];?></em></dd>
				<dd>采纳率:<em><?php echo $eve_star['ratio'];?>%</em></dd>
			<?php  }else{ ?>
				<dd class="rg">今日尚未有人回答问题</dd>
			<?php }?>
		</dl>
		<dl>
			<dt>历史回答问题最多之人</dt>
			<dd><?php echo $his_star['username'];?></dd>
			<dd><img src="http://localhost/wenda/Index/Tpl/Public/image/user.png" alt="fdsf" /></dd>
			<dd>回答数:<em><?php echo $his_star['answer'];?></em></dd>
			<dd>采纳率:<em><?php echo $his_star['ratio'];?>%</em></dd>
		</dl>
	</div>
</div>
<!-- 右侧区域结束 -->
	</div>
	<div id="honor_wall">
		<h3>SF光荣榜</h3>
		
			<table>
				<tr bgcolor="#f10844"><th>用户名</th><th>采纳数</th></tr>
			<?php if(isset($helper) && !empty($helper)):$_id_n=0;$_index_n=0;$lastn=min(1000,count($helper));
$hd["list"]["n"]["first"]=true;
$hd["list"]["n"]["last"]=false;
$_total_n=ceil($lastn/1);$hd["list"]["n"]["total"]=$_total_n;
$_data_n = array_slice($helper,0,$lastn);
if(count($_data_n)==0):echo "";
else:
foreach($_data_n as $key=>$n):
if(($_id_n)%1==0):$_id_n++;else:$_id_n++;continue;endif;
$hd["list"]["n"]["index"]=++$_index_n;
if($_index_n>=$_total_n):$hd["list"]["n"]["last"]=true;endif;?>

				<tr><td><?php echo $n['username'];?></td><td><?php echo $n['accept'];?></td></tr>
			<?php $hd["list"]["n"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
			</table>
		
	</div>
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