$(function(){
	$('button.close').on('click', function(){
		event.preventDefault();
		var dataDismiss = $(this).data('dismiss');
		$(this).closest('.'+dataDismiss).remove();
	});












});