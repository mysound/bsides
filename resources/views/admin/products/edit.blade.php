@extends('admin.layouts.app-admin')

@section('javascript')
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector:'textarea'
		});
	</script>
@endsection

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Edit a product @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.product.update', $product) }}" enctype="multipart/form-data">
			@method('PUT')
			@csrf
			@include('admin.products.partials.form')
		</form>
	</div>
@endsection