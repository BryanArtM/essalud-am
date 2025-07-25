
@if ($pagina->lastPage() > 1)
<div class="flex justify-center mt-6 space-x-1 items-center text-sm p-4">
    {{-- Flecha izquierda --}}
    @if ($pagina->onFirstPage())
        <button disabled class="btn pagination-arrow opacity-50 cursor-not-allowed p-2 rounded">
            <svg viewBox="0 0 32 32" class="w-4 h-4 fill-current text-gray-400">
                <path d="M21.7071 5.29289C22.0976 5.68342 22.0976 6.31658 21.7071 6.70711L12.4142 16L21.7071 25.2929C22.0976 25.6834 22.0976 26.3166 21.7071 26.7071C21.3166 27.0976 20.6834 27.0976 20.2929 26.7071L10.2929 16.7071C9.90237 16.3166 9.90237 15.6834 10.2929 15.2929L20.2929 5.29289C20.6834 4.90237 21.3166 4.90237 21.7071 5.29289Z"/>
            </svg>
        </button>
    @else
        <a href="{{ $pagina->previousPageUrl() }}" class="btn pagination-arrow p-2 rounded hover:bg-blue-100">
            <svg viewBox="0 0 32 32" class="w-4 h-4 fill-current text-[#0073B6]">
                <path d="M21.7071 5.29289C22.0976 5.68342 22.0976 6.31658 21.7071 6.70711L12.4142 16L21.7071 25.2929C22.0976 25.6834 22.0976 26.3166 21.7071 26.7071C21.3166 27.0976 20.6834 27.0976 20.2929 26.7071L10.2929 16.7071C9.90237 16.3166 9.90237 15.6834 10.2929 15.2929L20.2929 5.29289C20.6834 4.90237 21.3166 4.90237 21.7071 5.29289Z"/>
            </svg>
        </a>
    @endif
    @for ($i = 1; $i <= $pagina->lastPage(); $i++)
        @if (
            $i == 1 || 
            $i == $pagina->lastPage() || 
            ($i >= $pagina->currentPage() - 1 && $i <= $pagina->currentPage() + 1)
        )
            @if ($i == $pagina->currentPage())
                <span class="px-3 py-1 rounded bg-[#2997d6] text-white font-semibold">{{ $i }}</span>
            @else
                <a href="{{ $pagina->url($i) }}" class="px-3 py-1 rounded text-[#0073B6] hover:bg-blue-100">{{ $i }}</a>
            @endif
            @php $dots = false; @endphp
        @elseif (!$dots)
            <span class="px-2 text-gray-500">...</span>
            @php $dots = true; @endphp
        @endif
    @endfor
    {{-- Flecha derecha --}}
    @if ($pagina->hasMorePages())
        <a href="{{ $pagina->nextPageUrl() }}" class="btn pagination-arrow p-2 rounded hover:bg-blue-100">
            <svg viewBox="0 0 32 32" class="w-4 h-4 fill-current text-[#0073B6]">
                <path d="M10.2929 5.29289C9.90237 5.68342 9.90237 6.31658 10.2929 6.70711L19.5858 16L10.2929 25.2929C9.90237 25.6834 9.90237 26.3166 10.2929 26.7071C10.6834 27.0976 11.3166 27.0976 11.7071 26.7071L21.7071 16.7071C22.0976 16.3166 22.0976 15.6834 21.7071 15.2929L11.7071 5.29289C11.3166 4.90237 10.6834 4.90237 10.2929 5.29289Z"/>
            </svg>
        </a>
    @else
        <button disabled class="btn pagination-arrow opacity-50 cursor-not-allowed p-2 rounded">
            <svg viewBox="0 0 32 32" class="w-4 h-4 fill-current text-gray-400">
                <path d="M10.2929 5.29289C9.90237 5.68342 9.90237 6.31658 10.2929 6.70711L19.5858 16L10.2929 25.2929C9.90237 25.6834 9.90237 26.3166 10.2929 26.7071C10.6834 27.0976 11.3166 27.0976 11.7071 26.7071L21.7071 16.7071C22.0976 16.3166 22.0976 15.6834 21.7071 15.2929L11.7071 5.29289C11.3166 4.90237 10.6834 4.90237 10.2929 5.29289Z"/>
            </svg>
        </button>
    @endif
</div>
@endif