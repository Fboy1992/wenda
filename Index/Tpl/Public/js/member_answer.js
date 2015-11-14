$(function() {
	//我的回答，交替显示特效
	$('.ask-filter li').each(function(i) {
		$(this).mouseover(function() {
			$(this).css('background','#f10844').siblings().css('background','none');
			$('ul div.list-filter').eq(i).css('display','block').siblings().css('display', 'none');
		});
	});
});