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
				<form action="{{ route('admin.import.imgstore') }}" method="GET" class="form-horizontal">
                    @csrf
					<label for="">Start String</label>
					<input class="form-control" type="text" name="startstr" placeholder="http://bsides.ru/img/" required="">
					<br>
					<label for="">End String</label>
					<input class="form-control" type="text" name="endstr" placeholder=".jpg" required="">
                    <br>
                    <input class="btn btn-success" type="submit" value="Import">
                </form>
			</div>
		</div>
	</div>
@endsection