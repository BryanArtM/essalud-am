@props(['text' => 'Aplicar Filtros'])

<button type="submit"
    class="bg-blue-400 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs shadow flex items-center gap-1 transition-colors duration-200"
    title="Aplicar Filtros">

    <svg class="w-5 h-5 lg:w-6 lg:h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z"
            stroke="currentColor" stroke-width="2" />
        <path d="M14 14L16 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M15 11.5C15 13.433 13.433 15 11.5 15C9.567 15 8 13.433 8 11.5C8 9.567 9.567 8 11.5 8C13.433 8 15 9.567 15 11.5Z"
            stroke="currentColor" stroke-width="2" />
    </svg>

    <span>{{ $text }}</span>
</button>