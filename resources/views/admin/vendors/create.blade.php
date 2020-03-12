@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Creating a vendor @endslot
			@slot('parent') Main @endslot
			@slot('active') Vendors @endslot
		@endcomponent
		<hr>
		<form method="POST" class="form-horizontal" action="{{ route('admin.vendor.store') }}">
			@csrf
			@include('admin.vendors.partials.form')
		</form>
	</div>
@endsection