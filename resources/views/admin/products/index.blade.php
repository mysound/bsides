@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Product List @endslot
			@slot('parent') Main @endslot
			@slot('active') Products <span class="badge badge-pill badge-info" >{{ $products->total() }}</span> @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-3">
				<a href="{{ route('admin.product.create') }}" class="btn btn-primary">+ Add Product</a>
			</div>
			<div class="col-md-3">
				<a href="{{ route('admin.export') }}" class="btn btn-secondary">EXPORT</a>				
			</div>
			<div class="col-md-3">
				<a href="{{ route('admin.import') }}" class="btn btn-success">IMPORT</a>				
			</div>
			<div class="col-md-3 text-right">
				<a href="{{ route('admin.product.quantity') }}" class="btn btn-info">NULLIFY QUANTITY</a>				
			</div>
		</div>
		<br>
		@if (session('status'))
		    <div class="alert alert-success">
		        {{ session('status') }}
		    </div>
		@endif
		<table class="table table-striped">
			<thead>
				<th>ID</th>
				<th>
					@if(request()->noImg)
						<a href="{{ route('admin.product.index', ['noImg' => false]) }}">Images</a>
					@else
						<a href="{{ route('admin.product.index', ['noImg' => true]) }}">No Images</a>
					@endif
				</th>
				<th>
					@if(request()->sortViews == 'ASC')
						<a href="{{ route('admin.product.index', ['searchField' => request()->searchField, 'sortViews' => 'DESC']) }}">Views &#9650;</a>
					@elseif(request()->sortViews == 'DESC' or request()->sortViews == '')
						<a href="{{ route('admin.product.index', ['searchField' => request()->searchField, 'sortViews' => 'ASC']) }}">Views @if(!request()->sortViews == '')&#9660;@endif</a>
					@endif
				</th>
				<th>
					@if(request()->sortCart == 'ASC')
						<a href="{{ route('admin.product.index', ['sortCart' => 'DESC']) }}">Cart &#9650;</a>
					@elseif(request()->sortCart == 'DESC' or request()->sortCart == '')
						<a href="{{ route('admin.product.index', ['sortCart' => 'ASC']) }}">Cart @if(!request()->sortCart == '')&#9660;@endif</a>
					@endif
				</th>
				<th>Name / Artist</th>
				<th>Title</th>
				<th>Qty</th>
				<th>
					@if(request()->sortPrice == 'ASC')
						<a href="{{ route('admin.product.index', ['sortPrice' => 'DESC']) }}">Price &#9650;</a>
					@elseif(request()->sortPrice == 'DESC' or request()->sortPrice == '')
						<a href="{{ route('admin.product.index', ['sortPrice' => 'ASC']) }}">Price @if(!request()->sortPrice == '')&#9660;@endif</a>
					@endif
				</th>
				<th>Category</th>				
				<th>Edit</th>
				<th class="text-right">Action</th>
			</thead>
			<tbody>
				@forelse($products as $product)
					<tr style="line-height: 40px;">
						<td>{{ $product->id }}</td>
						<td>
							@foreach($product->images as $image)
								<img class="img" src="{{ asset('storage/images/thumbnails/' . $image->title) }}" width="35">
								@break
							@endforeach
						</td>
						<td>{{ $product->counter->view_count }}</td>
						<td>{{ $product->counter->cart_count }}</td>
						<td>{{ $product->name }}</td>
						<td>{{ $product->title }}</td>
						<td>{{ $product->quantity }}</td>
						<td>{{ $product->price }}</td>
						<td>{{ $product->category->title }}</td>						
						<td><a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.product.destroy', $product) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="11" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="11">
						<ul class="pagination pull-right">{{ $products->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection