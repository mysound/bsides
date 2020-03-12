@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Vendor List @endslot
			@slot('parent') Main @endslot
			@slot('active') Nullify Quantity @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<ul>
					@foreach($vendors as $vendor)
						<li style="margin: 10px;"><a href="{{ route('admin.product.nullify', ['sku' => $vendor->vendor_sku]) }}" class="btn btn-info btn-block" onclick="if(confirm('SKU ?')){ return true }else{ return false }">{{ $vendor->title }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection