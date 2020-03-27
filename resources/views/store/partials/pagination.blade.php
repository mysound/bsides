<div class="b-pagination fullver">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <a href="#" class="disabled">&laquo;</a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
    @endif
    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <a class="disabled"><span>{{ $element }}</span></a>
        @endif

        <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
    @else
        <a href="#" class="disabled">&raquo;</a>
    @endif
</div>

<div class="b-pagination mver">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <a href="#" class="disabled">&laquo;</a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
    @endif

    <a class="active">{{ $paginator->currentPage() }}</a>
    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
    @else
        <a href="#" class="disabled">&raquo;</a>
    @endif
</div>