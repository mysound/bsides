@extends('admin.layouts.app-admin')

@section('content')
	<ul>
		<li><a href="{{ route('admin.category.index') }}">Categories</a></li>
		<li><a href="{{ route('admin.product.index') }}">Products</a></li>
		<li><a href="{{ route('admin.brand.index') }}">Brands</a></li>
		<li><a href="{{ route('admin.ganre.index') }}">Ganres</a></li>
		<li><a href="{{ route('admin.vendor.index') }}">Vendors</a></li>
		<li><a href="{{ route('admin.order.index') }}">Orders</a></li>
	</ul>
@endsection