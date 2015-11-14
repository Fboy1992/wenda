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