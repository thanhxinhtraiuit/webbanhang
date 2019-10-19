$(document).ready(function (){
	
	$('.loadmore').on('click',function (){
		var url=$(this).attr('url');
		var page=$(this).attr('page');
		page=parseInt(page)+1;
		$.ajax({
			url:url,
			method:'get',
			data:{
				page,

			},
			dataType:'json',
			success:function(data){
				// alert('asdsa');
				console.log(page);
				$('.loadmore').attr('page',page);
				var html='';
				for(var i=0;i<data.length;i++){
					html+= '<div class="col-md-6 col-lg-4 col-xl-3">'
           					+ '<div class="card text-center card-product">'
             				+ '<div class="card-product__img">'
                			+'<img class="card-img" src="../upload/'+data[i].hinh+' "alt="">'
                			+'<ul class="card-product__imgOverlay">'
                  			+'<li><button><i class="ti-search"></i></button></li>'
                  			+'<li><button class="themgiohang" id="'+data[i].id+' "><i class="ti-shopping-cart"></i></button></li>'
                  			+'<li><button><i class="ti-heart"></i></button></li>'
							              			+	'  </ul>'
							             		+		' </div>'
							           +  ' <div class="card-body">'
							                +'<p>Accessories</p>'
							              + ' <h4 class="card-product__title"><a href="../chi-tiet-san-pham/'+data[i].id+'/'+data[i].ten_khong_dau+'">'+data[i].ten_san_pham+'</a></h4>'
							              + ' <p class="card-product__price"> '+formatmoney(data[i].gia)+'đ</p>'
							+'              </div>'
							 + '          </div>'
							         + '</div>';
				}
				$('#lastnew').append(html);
			}

		});
	});

});