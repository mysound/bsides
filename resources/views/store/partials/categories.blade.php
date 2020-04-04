<ul>
	@foreach($categories as $category)
		@if($category->parent_id != 0)
			<li><a href="{{ route('store', ['category_id' => [$category->id], 'searchField' => $searchField, 'sortType' => $sortType, 'top_rs' => $top_rs]) }}">&mdash; {{ $category->title }}</a></li>
		@else
			<?php
				$cat = array();
				$parent_id = $category->id;
				foreach ($categories as $exam) {
					if ($exam->parent_id == $parent_id) {$cat[] = $exam->id;}
				}
			?>
			<li><a href="{{ route('store', ['category_id' => $cat, 'searchField' => $searchField, 'sortType' => $sortType, 'top_rs' => $top_rs]) }}">{{ $category->title }}</a></li>
		@endif
	@endforeach
</ul>