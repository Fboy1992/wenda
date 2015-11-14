/**
 * 验证js
 * 
 */
var validate = {
	username : false,
	passwd   : false,
	repasswd : false,
	code 	 : false,
	loginUsername : false,
	loginPwd : false,
	loginCode: false
}
var msg = '';

//验证表单
$(function() {
	/*注册点击事件*/
	$('.reg').click(function() {
		$('#reg').css({'display':'block'});
		
	});
	/*
	登陆点击事件
	 */
	$('.log').click(function() {
		$('#log').css({'display':'block'});
		
	});
	/*
	关闭按钮
	 */
	$('#reg_close').click(function() {
		$('#reg').css('display', 'none');
	});
	$('#log_close').click(function() {
		$('#log').css('display', 'none');
	});
	/*
	点击更换验证码图片
	 */
	$('.verify-img').click(function() {
		$(this).attr('src', APP + '/Reg/code/' + Math.random());
	});
	/*
	注册表单验证
	 */
	//拿出表单对象
	var register = $('form[name=register]');
	//注册事件-->响应函数
	register.submit(function() {
		var isOk = validate.username && validate.passwd && validate.repasswd && validate.code;
		
		if (isOk) {
			$('#reg').css({'display':'none'});
			return true;
		}
		//点击提交按钮依次触发失去焦点, 再次验证
		$('input[name=username]', register).trigger('blur');
		$('input[name=passwd]', register).trigger('blur');
		$('input[name=repasswd]', register).trigger('blur');
		$('input[name=code]', register).trigger('blur');
		return false;
	});
	//username input绑定blur事件
	$('input[name=username]', register).blur(function() {
		var username = $(this).val();
		var span = $(this).parent().next();
		//不能为空
		if (username == '') {
			msg = '(用户名不能为空)';
			span.text(msg).addClass('error');
			validate.username = false;
			return; 
		}
		//正则判断
		if (!/^\w{2,14}$/g.test(username)) {
			msg = '(必须是2-14个字母，数字和字符)';
			span.text(msg).addClass('error');
			validate.username = false;
			return;
		}

		//ajax异步验证用户名是否存在
		$.post(APP + '/Reg/ajax_username', {username : username}, function(status){
			if (status) {

				msg = '(用户名合法)';
				span.text(msg).removeClass('error');
				validate.username = true;
			} else {

				msg = '(用户名已存在!)';
				span.text(msg).addClass('error');
				validate.username = false;
				return;
			}
		},'json');
	});
	//passwd input绑定blur事件
	$('input[name=passwd]', register).blur(function() {
		var pwd = $(this).val();
		var span = $(this).parent().next();

		if (pwd == '') {
			msg = '(密码不能为空)';
			span.text(msg).addClass('error');
			validate.passwd = false;
			return;
		}
		//正则判断
		if (!/^\w{6,12}$/g.test(pwd)) {
			msg = '(6-20个字母，数字和字符)';
			span.text(msg).addClass('error');
			validate.passwd = false;
			return;
		}
		msg = '(密码设置合法)';
		span.text(msg).removeClass('error');
		validate.passwd = true;
	});
	//repasswd input绑定事件，确认密码
	$('input[name=repasswd]', register).blur(function() {
		var pwd = $('input[name=passwd]', register).val();
		var repwd = $(this).val();
		var span = $(this).parent().next();
		if (repwd == '') {
			msg = '(密码确认不能为空)';
			span.text(msg).addClass('error');
			validate.passwd = false;
			return;
		}
		if (repwd !== pwd) {
			msg = '(两次密码不一致)';
			span.text(msg).addClass('error');
			validate.repasswd = false;
			return;
		}
		msg = '(密码一致)';
		span.text(msg).removeClass('error');
		validate.repasswd = true;
	});
	//code inpu绑定事件 验证验证码
	$('input[name=code]', register).blur(function() {
		var code = $(this).val();
		var span = $(this).parent().next();
		//不能为空
		if (code == '') {
			msg = '(请输入验证码)';
			span.text(msg).addClass('error');
			validate.code = false;
			return;
		}
		//异步验证, 验证验证码是否一样
		//code ： code 
		//是键值对，第一个code代表表单中的name，第二个code是该表单的value
		$.post(APP + "/Reg/ajax_code", {code : code},function(status){
			if (status) {
				msg = '(验证码正确)';
				span.text(msg).removeClass('error');
				validate.code = true;
			} else {
				msg = '(验证码不正确)';
				span.text(msg).addClass('error');
				validate.code = false;
				return;
			}
		}, 'json');
	});

	/*
	登陆form表单验证
	 */
	var login = $('form[name=login]');
	//登陆提交事件
	login.submit(function() {
		console.log(validate.loginUsername && validate.loginPwd);
		if (validate.loginUsername && validate.loginPwd) {
			$('#log').css({'display':'none'});
			return true;
		}
		$('input[name=username]', login).trigger('blur');
		$('input[name=passwd]', login).trigger('blur');
		return false;
	});
	//验证用户名
	$('input[name=username]', login).blur(function() {
		//为空时
		var username = $(this).val();
		var span = $(this).parent().next();
		//不能为空
		if (username == '') {
			msg = '(请输入账户)';
			span.text(msg).addClass('error');
			validate.loginUsername = false;
			return; 
		}
		//ajax验证用户名是否存在？

		
		
	});
	//验证密码
	$('input[name=passwd]', login).blur(function() {
		var pwd = $(this).val();
		var span = $(this).parent().next();

		//不能为空
		if (pwd == '') {
			msg = '(请输入密码)';
			span.text(msg).addClass('error');
			validate.loginPwd = false;
			return;
		}
		var data = {
			username : $('input[name=username]', login).val(),
			pwd 	 : pwd
		}
		$.post(APP + '/Login/ajax_login', data, function(status) {

			if (status) {
				
				span.text('--合法--').removeClass('error');
				$('input[name=username]', login).parent().next().text('--合法--').removeClass('error');
				validate.loginUsername = true;
				validate.loginPwd = true;
			} else {
				span.text('密码可能不正确').addClass('error');
				$('input[name=username]', login).parent().next().text('账户可能不存在').addClass('error');
				validate.loginUsername = false;
				validate.loginPwd = false;
				return;
			}
		}, 'json');
	});
	
});