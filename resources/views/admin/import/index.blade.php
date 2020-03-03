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
				<ul>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'BS-CAT-']) }}" class="btn btn-info btn-block">B-Sides Catalog</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'WMR-']) }}" class="btn btn-info btn-block">Warner Music</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'UMG-']) }}" class="btn btn-info btn-block">Universal Music</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.import.create', ['sku' => 'UMRU-']) }}" class="btn btn-info btn-block">Universal Music CYR</a></li>
				</ul>
			</div>
		</div>
	</div>
@endsection