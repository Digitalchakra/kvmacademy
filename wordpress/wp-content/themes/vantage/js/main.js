$(document).ready(function(){
	$('.toggle_services').click(function(){
		var id=$(this).attr('id');
		$('.display_none').removeClass('display_block');
		$('#a_'+id).addClass('display_block');
		$('.toggle_services').removeClass('active');
		$(this).addClass('active');
	});
});