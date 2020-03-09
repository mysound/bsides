@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Category List @endslot
			@slot('parent') Main @endslot
			@slot('active') Categories @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<a href="{{ route('admin.category.create') }}" class="btn btn-primary">+ Add New Category</a>
			</div>
		</div>
		<br>
		<table class="table table-striped">
			<thead>
				<th>id</th>
				<th>Title</th>
				<th>Parent_id</th>
				<th>Edit</th>
				<th class="text-right">Delete</th>
			</thead>
			<tbody>
				@forelse($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->title }}</td>
					<td>{{ $category->parent_id }}</td>
					<td><a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
					<td class="text-right">
						<form method="POST" action="{{ route('admin.category.destroy', $category) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
						@method('DELETE')
						@csrf
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
					</td>
				</tr>
				@empty
					<tr>
						<td colspan="5" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5">
						<ul class="pagination pull-right"></ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection