$(document).ready(function (){

	$('.otimkiem').on('keypress',function (){
		var key = $(this).val();
		$.ajax({
			url:'',
			method:'get',
			data:{
				key,

			},
			dataType:'json',
			success:function(data){
				
			}
		});
	});

});