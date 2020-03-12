@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Edit a Brand @endslot
			@slot('parent') Main @endslot
			@slot('active') Brands @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.brand.update', $brand) }}">
			@method('PUT')
			@csrf
			@include('admin.brands.partials.form')
		</form>
	</div>
@endsection