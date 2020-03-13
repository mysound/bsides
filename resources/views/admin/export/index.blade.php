@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Export List @endslot
			@slot('parent') Main @endslot
			@slot('active') Export @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<ul>
					<li style="margin: 10px;"><a href="{{ route('admin.export.main') }}" class="btn btn-info btn-block">All B-Sides Catalog for Ebay</a></li>
					<li style="margin: 10px;"><a href="{{ route('admin.export.main', ['ebayitem' => true]) }}" class="btn btn-info btn-block">Don't Have Ebay ID</a></li>
				</ul>
			</div>
		</div>
	</div>
@endsection