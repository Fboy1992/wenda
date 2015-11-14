$(function() {
	var cateId = 0;
	//弹窗
	$('#sel-cate').click(function() {
		$('#category').css('display', 'block');
	});
	//关闭
	$('.close-window').click(function() {
		$('#category').slideUp();
	});
	//选择分类
	$('select[name=cate-one').change(function() {
		/*
		每次点击，change时，就异步调用
		 */
		//取出当前对象
		var obj = $(this);
		if (obj.index() < 3) {
			var pid = obj.val();
			//异步发送
			$.post(APP + '/Ask/get_cate', {pid : pid}, function(data) {
				if (data) {

					//循环option
					var option = '';//字符串
					/*
					$.each方法， data是数组或者对象，
					 */
					$.each(data, function(i, k) {
						option += '<option value="' + k.cid + '">' + k.title + "</option>";
					});
					obj.next().html(option).css({'display': 'inline-block'}); 

				} else {
					obj.next().html('').css({'display': 'inline-block'}); 
				}
			}, 'json');
		}
		cateId = obj.val();
	});

	//点击"确定",触发的情况
	$('#ok').click(function() {
		if (!cateId) {
			alert('请选择一个分类');
			return;
		}
		//给隐藏的input加cid
		$('input[name=cid]').val(cateId);

		//触发关闭事件
		$('.close-window').click();
	});

	//判断内容是否完整
	$('.send-btn').click(function() {
		//获取textarea
		var cons = $('textarea[name=content]');

		//内容为空时
		if (cons.val()=='') {
			alert('请输入提问内容');
			cons.focus();
			return false;
		}
		//判断是否选择分类
		if (!cateId) {
			alert('请选择一个分类');
			cons.focus();
			return false;
		}
		//判断用户是否登陆
		if (!on) {
			$('.log').click();
			return false;
		}
		cons.val() = '';
	});

	//设置金币可以选择的范围
	var opt = $('select[name=reward] option');

	for (var i=0; i<opt.length; i++) {
		//如果option的值大于用户金币数，则不可选
		if (opt.eq(i).val() > point) {
			opt.eq(i).attr('disabled', 'disabled');
		}
	}
});