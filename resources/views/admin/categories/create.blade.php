@extends('admin.layouts.app-admin')

@section('content')
	<h1>Creating a new category</h1>
	<hr>
	<form method="POST" class="form-horizontal" action="{{ route('admin.category.store') }}">
		@csrf
		@include('admin.categories.partials.form')
	</form>
@endsection