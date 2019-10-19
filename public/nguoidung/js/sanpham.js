function sapxep(dem,url,iddanhmuc,page){
 $.ajax({
 		url:url,
 		method:'get',
 		dataType:'json',
 		data:{
 			page,
 			iddanhmuc,
 		},
 		success:function(data){
 				if(dem==0){
 					$('#danhsachsp').empty();
 				}
 				dem++;
 				var html='';

 				for(var i=0;i<data.length;i++){
 					html=html+
 			'<div class="col-md-6 col-lg-4">'
               + '<div class="card text-center card-product">'
                +  '<div class="card-product__img">'
                +    '<img class="card-img" src="/upload/'+data[i].hinh +'" alt="">'
                +    '<ul class="card-product__imgOverlay">'
                +      '<li><button><i class="ti-search"></i></button></li>'
                +      '<li><button><i class="ti-shopping-cart themgiohang" id='+data[i].id+' gia='+data[i].gia+' ></i></button></li>'
                +      '<li><button><i class="ti-heart"></i></button></li>'
                +'    </ul>'
              +'    </div>'
               + '  <div class="card-body">'
                +  '  <p>Accessories</p>'
                +   ' <h4 class="card-product__title"><a href="#">'+data[i].ten_san_pham+'</a></h4>'
                +    '<p class="card-product__price">'+data[i].gia+'</p>'
                +  '</div>'
               + '</div>'
             + '</div>'

          }
          $('#danhsachsp').append(html);
 		}
 });
}

$('#select-sx').on('change',function(){
	var url=$(this).find('option:selected').attr('url');
	 var dem=0;
	 var iddanhmuc=$('#iddanhmuc').val();
	 sapxep(dem,url,iddanhmuc,0);
});
