@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Import List @endslot
			@slot('parent') Main @endslot
			@slot('active') Pre-Order Import @endslot
		@endcomponent
		@include('admin.layouts.errors-admin')
		<div class="row">
			<div class="col-md-4">
				<form action="{{ route('admin.import.preorderstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                    	<div class="input-group-prepend">
                    		<span class="input-group-text" id="basic-addon1">SKU</span>
						</div>
						<input class="form-control" type="text" name="sku_title" value="WMR-" readonly="">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon2">EUR</span>
						</div>
                    	<input class="form-control" type="text" name="currency_eur" aria-describedby="basic-addon2" value="70">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon3">Choose Execl File</span>
                    	</div>
                		<input class="form-control" type="file" name="import_file" aria-describedby="basic-addon3">
                	</div>
                    <input class="btn btn-success" type="submit" value="Import">
                </form>
			</div>
		</div>
	</div>
@endsection