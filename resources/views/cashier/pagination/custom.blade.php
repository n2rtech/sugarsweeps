<div class="row mt-4">
    <div class="col-xl-4 col-md-6 col-sm-6">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-round has-gap">
                @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"><a
                        class="page-link" href="#">Previous</a></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">Previous</a></li>
                @endif
                @foreach ($elements as $element)
                @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><a class="page-link" href="#">{{ $element }}</a>
                </li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item disabled active" aria-disabled="true"><a class="page-link" href="#">{{ $page }}</a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach
                @endif
                @endforeach
                @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">Next</a></li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"><a
                        class="page-link" href="#">Next</a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
