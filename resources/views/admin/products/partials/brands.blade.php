@foreach($brands as $brand)
	<option value="{{ $brand->id ?? "" }}"
		@isset($product->brand)
			@if($brand->id == $product->brand->id)
				selected="selected" 
			@endif
		@endisset
		>
		{{ $brand->title ?? "" }}
	</option>
@endforeach