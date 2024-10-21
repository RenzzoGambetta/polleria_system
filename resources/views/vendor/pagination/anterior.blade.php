@if ($paginator->hasPages())
    <ul class="pagination_si">

        {{--Anterior Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" id="centra" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Siguiente"> Siguiente <i class='bx bxs-arrow-from-left'></i></a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="Siguiente">
                <span class="page-link" id="centra"  style='color:#bb0e0e' aria-hidden="true"> Siguiente <i class='bx bxs-arrow-from-left'></i></span>
            </li>
        @endif
    </ul>
@endif
