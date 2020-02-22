@extends('admin.layouts.app-admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a Brand @endslot
			@slot('parent') Main @endslot
			@slot('active') Brands @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.brand.store') }}">
			@csrf
			@include('admin.brands.partials.form')
		</form>
	</div>
@endsection