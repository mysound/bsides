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
				<form action="{{ route('admin.import.mainstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="import_file">
                    <input type="submit" value="Import">
                </form>
			</div>
		</div>
	</div>
@endsection