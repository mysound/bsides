@extends('admin.layouts.app-admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a product @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
			@csrf
			@include('admin.products.partials.form')
		</form>
	</div>
@endsection