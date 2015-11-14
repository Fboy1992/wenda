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