@if (count($breadcrumbs))
	<div>
	    <ul class="breadcrumb">Результат поиска: 
	        @foreach ($breadcrumbs as $breadcrumb)

	            @if ($breadcrumb->url && !$loop->last)
	                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
	            @else
	                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
	            @endif

	        @endforeach
	    </ol>
	</div>

@endif