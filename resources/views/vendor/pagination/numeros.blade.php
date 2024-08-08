@if ($paginator->hasPages())
    <ul class="pagination_nu" id="centra" >
        {{-- Enlace a la página anterior --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="Anterior">
                <span class="page-link" aria-hidden="true"><i class='bx bx-caret-left' style='color:#bb0e0e' ></i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" id="icon_paginacion" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Anterior"><i class='bx bx-caret-left bx-flashing' ></i></a>
            </li>
        @endif

        {{-- Números de página --}}
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                <li id="{{ ($i == $paginator->currentPage()) ? 'border_ac' : 'border' }}">
                    <a  class="page-link" id="{{ ($i == $paginator->currentPage()) ? 'nu_text_ac' : 'nu_text' }}"  href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor

        {{-- Enlace a la página siguiente --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" id="icon_paginacion" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Siguiente"><i class='bx bx-caret-right bx-flashing' ></i></a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="Siguiente">
                <span class="page-link" aria-hidden="true"><i class='bx bx-caret-right' style='color:#bb0e0e'  ></i></span>
            </li>
        @endif
    </ul>
@endif
