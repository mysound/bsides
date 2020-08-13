@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Import List @endslot
			@slot('parent') Main @endslot
			@slot('active') Import @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<ul>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'BSC-']) }}" class="btn btn-info btn-block">B-Sides Catalog</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'WMR-']) }}" class="btn btn-info btn-block">Warner Music</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'UMG-']) }}" class="btn btn-info btn-block">Universal Music</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'UMRU-']) }}" class="btn btn-info btn-block">Universal Music CYR</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'ebay']) }}" class="btn btn-success btn-block">Import ebay File Exchange</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.import.preorder') }}" class="btn btn-success btn-block">Warner Music Pre-Order - Import File</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<ul>
					<li style="margin: 10px;"><a href="{{ route('admin.import.imgcreate') }}" class="btn btn-warning btn-block">Import Images</a></li>
				</ul>
			</div>
		</div>
	</div>
@endsection