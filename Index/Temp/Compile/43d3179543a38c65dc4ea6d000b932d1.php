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