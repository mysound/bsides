@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Vendor List @endslot
			@slot('parent') Main @endslot
			@slot('active') Nullify Quantity @endslot
		@endcomponent
		<div class="row">
			@foreach($vendors as $vendor)
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">{{ $vendor->title }}</h5>
						<p class="card-text">Обнуление количества в базе данных</p>
						<a href="{{ route('admin.product.nullify', ['sku' => $vendor->vendor_sku]) }}" class="btn btn-info btn-block" onclick="if(confirm('Обнулить каталог {{ $vendor->title }}?')){ return true }else{ return false }" style="font-size: 18px; color: #fff">{{ $vendor->title }}</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection