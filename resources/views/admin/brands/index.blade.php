@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Brands List @endslot
			@slot('parent') Main @endslot
			@slot('active') Brands @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<a href="{{ route('admin.brand.create') }}" class="btn btn-primary pull-right">+ Add Brand</a>
			</div>
		</div>
		<br>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th>Edit</th>
				<th class="text-right">Delete</th>
			</thead>
			<tbody>
				@forelse($brands as $brand)
					<tr>
						<td>{{ $brand->title }}</td>
						<td><a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.brand.destroy', $brand) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="3" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<ul class="pagination pull-right">{{ $brands->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection