@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Vendors List @endslot
			@slot('parent') Main @endslot
			@slot('active') Vendors @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<a href="{{ route('admin.vendor.create') }}" class="btn btn-primary pull-right">+ Add Vendor</a>
			</div>
		</div>
		<br>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th>Vendor SKU</th>
				<th>Edit</th>
				<th class="text-right">Delete</th>
			</thead>
			<tbody>
				@forelse($vendors as $vendor)
					<tr>
						<td>{{ $vendor->title }}</td>
						<td>{{ $vendor->vendor_sku }}</td>
						<td><a href="{{ route('admin.vendor.edit', $vendor->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.vendor.destroy', $vendor) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						<ul class="pagination pull-right">{{ $vendors->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection