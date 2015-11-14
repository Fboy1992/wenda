/**
 * 选项卡动画
 * 
 */
$(function() {

	//在自身上使用，直接使用
	$('.ans-sel li').mouseover(function() {
		$(this).css({'background':'#24ad41'}).siblings('li').css({'background':'none'});
	});

});