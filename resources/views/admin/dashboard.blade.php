@extends('admin.layouts.app-admin')

@section('content')
	<ul>
		<li><a href="{{ route('admin.category.index') }}">Categories</a></li>
		<li><a href="{{ route('admin.product.index') }}">Products</a></li>
		<li><a href="{{ route('admin.ganre.index') }}">Ganre</a></li>
		<li><a href="{{ route('admin.brand.index') }}">Brands</a></li>
	</ul>
@endsection