@extends('admin.layouts.app-admin')

@section('content')
	@component('admin.components.breadcrumb')
		@slot('title') Edit Category @endslot
		@slot('parent') Main @endslot
		@slot('active') Categories @endslot
	@endcomponent
	<div class="container panel panel-default">
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.category.update', $category) }}">
			@method('PUT')
			@csrf
			@include('admin.categories.partials.form')
		</form>
	</div>
@endsection