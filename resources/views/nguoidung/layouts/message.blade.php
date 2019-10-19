	@if(session('thanh-cong'))
		<script type="text/javascript">
			toastr.success('{{ session('thanh-cong') }}','')
		</script>
	@endif
	@if(session('that-bai'))
		<script type="text/javascript">
			toastr.error('{{ session('that-bai') }}','')
		</script>
	@endif
	@if($errors->any())
		<script type="text/javascript">
			@foreach($errors->all() as $error)
				toastr.error('{{ $error }}','')
			@endforeach

		</script>
	@endif
