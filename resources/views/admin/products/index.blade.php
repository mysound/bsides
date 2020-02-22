@extends('admin.layouts.app-admin')

@section('content')
	<div class="container panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Product List @endslot
			@slot('parent') Main @endslot
			@slot('active') Products @endslot
		@endcomponent
		<hr>
		<div class="row">
			<div class="col-md-3">
				<a href="{{ route('admin.product.create') }}" class="btn btn-primary">+ Add Product</a>
				<br><br>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<th></th>
				<th>Name / Artist</th>
				<th>Title</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Published</th>
				<th>Edit</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($products as $product)
					<tr style="line-height: 40px;">
						<td>
							@foreach($product->images as $image)
								<img class="img" src="{{ asset('storage/images/thumbnails/' . $image->title) }}" width="35">
								@break
							@endforeach
						</td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->title }}</td>
						<td>{{ $product->quantity }}</td>
						<td>$ {{ $product->price }}</td>
						<td>{{ $product->published }}</td>
						<td><a href="{{ route('admin.product.edit', $product->id) }}">Edit</a></td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.product.destroy', $product) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="8" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="8">
						<ul class="pagination pull-right">{{ $products->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection