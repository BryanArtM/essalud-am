@props(['href', 'text' => 'Quitar Filtros'])

<a href="{{ $href }}"
    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded shadow text-sm transition-colors duration-200">
    {{ $text }}
</a>