/**
 * 无限分类js
 */
$(function() {
	//隐藏pid不是0的tr
	$('tr[pid!=0]').hide();
	//让pid=cid的显示
	//第一次点击
	$('.showPlus').toggle(function() {
		$(this).removeClass().addClass('showMinus');
		var index = $(this).parents('tr').attr('cid');
		$('tr[pid='+ index +']').show();
	//第二次点击
	},function() {
		$(this).removeClass().addClass('showPlus');
		var index = $(this).parents('tr').attr('cid');
		$('tr[pid='+ index +']').hide();
	}); 
});