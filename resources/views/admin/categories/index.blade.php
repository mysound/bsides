@extends('admin.layouts.app-admin')

@section('content')
	
	@component('admin.components.breadcrumb')
		@slot('title') Category List @endslot
		@slot('parent') Main @endslot
		@slot('active') Categories @endslot
	@endcomponent
	<hr>
	<a href="{{ route('admin.category.create') }}" class="btn btn-primary pull-right">Add New Category</a>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-sm">id</div>
			<div class="col-sm">Title</div>
			<div class="col-sm">Parent_id</div>
			<div class="col-sm">Edit</div>
			<div class="col-sm">Delete</div>
		</div>
		<hr>
		@foreach($categories as $category)
			<div class="row">
				<div class="col-sm">{{ $category->id }}</div>
				<div class="col-sm">{{ $category->title }}</div>
				<div class="col-sm">{{ $category->parent_id }}</div>
				<div class="col-sm"><a href="{{ route('admin.category.edit', $category->id) }}">Edit</a></div>
				<div class="col-sm">
					<form method="POST" action="{{ route('admin.category.destroy', $category) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
						@method('DELETE')
						@csrf
						<button type="submit" class="btn btn-primary">Delete</button>
					</form>
				</div>
			</div>
			<hr>
		@endforeach
	</div>
@endsection