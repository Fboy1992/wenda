$(function() {
	
	//轮播图
	var timer = null;
	var num = 0;
	timer = setInterval(function() {
		num = num%3;
		var p = '-540'*num;
		$('.img p').animate({'left':p},"600","swing");
		num++;
	}, 2000);
	$('.tab_ul a').each(function(i) {
		$(this).mouseover(function() {
			var p = '-540'*i;
			clearInterval(timer);
			$('.img p').animate({'left':p},"600","swing");
		});
		$(this).mouseout(function() {
			timer = setInterval(function() {
			num = num%3;
			var p = '-540'*num;
			$('.img p').animate({'left':p},"600","swing");
				num++;
			}, 2000);
		});
	});

	//问题轮播版
	$('.title span').each(function(i) {
		$(this).mouseover(function() {
			$(this).css({'background':'#24ad41'}).siblings().css({'background':'none'});
			$('.detail ul').eq(i).css({'display':'block'}).siblings('ul').css({'display':'none'});
		});
	});
	

});