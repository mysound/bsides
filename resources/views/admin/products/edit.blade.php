@extends('admin.layouts.app-admin')

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