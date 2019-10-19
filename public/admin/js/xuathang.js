$('#slid').on('change',function(){
		alert("abc");
		var url=$(this).find('option:selected').attr('url');
		var id=$(this).find('option:selected').attr('name');
		

		$.ajax({
			url:'',
			method:'url',
			dataType:'json',
			data:
				prid,
			success:function(data){
				var html='';
				html+= '@foreach ($data as $element)'
                       + ' <option value={{ $element->id }}>'
                       + '{{ $element->import_date }} + {{data->quantity}}'
                      +'</option>'
                      +'@endforeach'
			}
			 $('#danhsachsp').append(html);
			 
		});
	});
