$(function() {
	//显示边框
	$('#sub_nav dd').each(function(i) {
		$(this).mouseover(function() {
			$(this).css({'border':'2px solid #f1de08','border-right':'none','z-index':'100'});
			$('#sub_nav ul.c_ul').eq(i).css({'display':'block'})
		});
		$(this).mouseout(function() {
			$(this).css({'border':'2px solid transparent','border-right':'none','z-index':'0'});
			$('#sub_nav ul.c_ul').eq(i).css({'display':'none'});
		});
	});
	//导航ul显示
	$('#sub_nav ul.c_ul').each(function(i) {
		$(this).mouseover(function() {
			$('#sub_nav dd').eq(i).css({'border':'2px solid #f1de08','border-right':'none','z-index':'100'});
			$(this).css({'display':'block'});
		});
		$(this).mouseout(function() {
			$('#sub_nav dd').eq(i).css({'border':'2px solid transparent','border-right':'none','z-index':'0'});
			$(this).css({'display':'none'});
		});		
	});
	//ul中的 li 背景
	$('.c_ul li').mouseover(function() {
		$(this).css({'background':'#24ad41'});
	}).mouseout(function() {
		$(this).css({'background':'none'});
	});
	//问题库box显示
	$('.ask_list').mouseover(function() {
		$('.hidden').show();
	}).mouseout(function() {
		$('.hidden').hide();
	});
	$('.hidden').mouseover(function() {
		$(this).show();
	}).mouseout(function() {
		$(this).hide();
	});
});