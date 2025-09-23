@props(['href', 'text' => 'Quitar Filtros'])

<a href="{{ $href }}"
    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-2 py-1 rounded text-xs shadow flex items-center gap-1 transition-colors duration-200"
    title="Quitar Filtros">
    <svg class="w-5 h-5 lg:w-6 lg:h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 9L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15 9L9 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
    {{ $text }}
</a>