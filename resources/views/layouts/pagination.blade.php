@if ($paginator->hasPages())
    <div class="pagination">

        @if ($paginator->onFirstPage())
            <a href="#" disabled>&laquo;</a>
        @else
            <a class="active-page" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a href="#">{{ $element }}</a>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active-page" href="#">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @else
            <a href="#">&raquo;</a>
        @endif
    </div>
@endif

