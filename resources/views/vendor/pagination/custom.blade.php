<nav class="tg-pagination">
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="tg-prevpage tg-disabled"><span><i class="fa fa-angle-left"></i></span></li>
        @else
        <li class="tg-prevpage"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="tg-active"><span>{{ $page }}</span></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="tg-nextpage"><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
        @else
        <li class="tg-nextpage tg-disabled"><span><i class="fa fa-angle-right"></i></span></li>
        @endif
    </ul>
</nav>
