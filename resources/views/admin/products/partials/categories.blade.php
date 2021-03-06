@foreach($categories as $category)
	<option value="{{ $category->id ?? "" }}"
		
		@isset($product->id)
			@if($category->id == $product->category->id)
				selected="selected" 
			@endif
		@endisset

		@if($category->parent_id == 0)
			disabled=""
		@endif
		>
		{!! $separator ?? "" !!}{{ $category->title ?? "" }}
	</option>

	@if(count($category->children) > 0)
		@include('admin.products.partials.categories', [
				'categories' => $category->children,
				'separator'  => ' - ' . $separator
			])
	@endif
@endforeach