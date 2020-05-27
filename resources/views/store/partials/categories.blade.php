<ul>
	@foreach($categories as $category)
		@if($category->parent_id != 0)
			<li><a href="{{ route('category', [$category->slug, $searchField ?? ""]) }}">&mdash; {{ $category->title }}</a></li>
		@else
			<li><a href="{{ route('category', [$category->slug, $searchField ?? ""]) }}">{{ $category->title }}</a></li>
		@endif
	@endforeach
</ul>