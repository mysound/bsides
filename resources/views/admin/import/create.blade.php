@extends('admin.layouts.app-admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Import List @endslot
			@slot('parent') Main @endslot
			@slot('active') Import @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<form action="{{ route('admin.import.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="if(confirm('SKU {{$sku_title}}?')){ return true }else{ return false }">
                    @csrf
					<input class="form-control" type="text" name="sku_title" value="{{ $sku_title ?? 'ERROR SKU TITLE'}}" readonly="">
                    <input class="form-control" type="file" name="import_file">
                    <br>
                    <input class="btn btn-success" type="submit" value="Import">
                </form>
			</div>
		</div>
	</div>
@endsection