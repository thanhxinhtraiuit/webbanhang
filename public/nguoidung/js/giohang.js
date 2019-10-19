$(document).ready(function(){
	tongtien();
	count();
	$(document).on('click','.themgiohang',function(){
		var id = $(this).attr('id');
		var gia = $(this).attr('gia');
		$.ajax({
			url:'/them-gio-hang',
			method:'get',
			data:{
				id:id,
				gia:gia,
			},
			success: function(data) {
       			// alert('abc');
       			// count();
       			var tong =$('.nav-shop__circle').text();
       			var tong =1+ parseInt(tong);
       			$('.nav-shop__circle').text(tong);
            }
		});

	});

	$('.btngiohang').on('click',function (){
		var url=$(this).attr('href');
		window.location.href=url;

	});

	$('.xoagiohang').on('click',function(){
		var key=$(this).attr('id');
		var bl =xoagiohang(key);
		if(bl==true){
			$(this).parent().parent().parent().remove();
		}


	});

	$('.increase').on('click',function(){

		var Quantity = $('#sst').val();
		Quantity=parseInt(Quantity) +1;
		if(Quantity==50) return false;
		$('#sst').val(Quantity);

	});
	$('.addcoupon').on('click',function(){

	});


	$('.reduced').on('click',function(){

		var Quantity = $('#sst').val();

		Quantity=parseInt(Quantity) -1;
		if(Quantity==0) return false;
		$('#sst').val(Quantity);

	});

});
function count(){
	$.ajax({
		url:'/tong-gio-hang',
		method:'get',
		success:function(data){
			$('.nav-shop__circle').text(data);
		}
	});
}
function xoagiohang(key){
	var bl;
	$.ajax({
		async:false,

		url:'/xoa-gio-hang',
		method:'get',
		data:{
			key:key,
		},
		success:function(data){
			// 
			count();
			tongtien();
			bl=true;

		}
	});
	return bl;
}
function tongtien(){
	$.ajax({
		url:'/tong-tien',
		method:'get',
		
		success:function(data){
			
			$('#tongtien').text(formatmoney(data));

		}

	});

}
function formatmoney(number){
	 return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}