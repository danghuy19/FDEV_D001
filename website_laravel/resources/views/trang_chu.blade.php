@extends('templates.template_green')

@section('main-content')

	@if($errors->noticeOrder->first())
	<script>
		alert('{{$errors->noticeOrder->first()}}')
	</script>
	@endif

	@include('modules.mod_ban_chay')

	@include('modules.mod_sp_noi_bat')

	@include('modules.mod_sp_moi')
@stop