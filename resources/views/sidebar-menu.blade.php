{{-- Sidebar fijo --}}
<aside class="fixed left-0 top-16 w-64 h-[calc(100vh-4rem)] bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-40 lg:z-40">
    <!-- Header del Sidebar -->
    <div class="px-3 py-3 border-b border-gray-100">
        <h3 class="text-base font-semibold text-gray-900 tracking-tight">Panel de Control</h3>
        <p class="text-sm text-gray-500 mt-1">Gestión del sistema</p>
    </div>

    <!-- Navegación Principal -->
    <nav class="px-4 pt-4 overflow-y-auto h-full pb-20">
        <div class="space-y-1">
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50 border-l-3 border-blue-500' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50 border-l-3 border-transparent hover:border-blue-500' }} transition-all duration-200">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v4m8-4v4"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('adultos.index') }}"
                class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('adultos.*') ? 'text-sky-600 bg-sky-100 0 border-l-3 border-sky-500' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50 border-l-3 border-transparent hover:border-blue-500' }} transition-all duration-200">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('adultos.*') ? 'text-sky-500' : 'text-gray-400 group-hover:text-sky-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span>Buscar Adultos Mayores</span>
            </a>

            <a href="{{ route('adultos.create') }}"
                class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('adultos.create') ? 'text-green-600 bg-green-100 border-l-3 border-green-500' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50 border-l-3 border-transparent hover:border-green-500' }} transition-all duration-200">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('adultos.create') ? 'text-green-500' : 'text-gray-400 group-hover:text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Nuevo Registro</span>
            </a>

            @if(auth()->user()->is_admin)
                <a href="{{ route('users.index') }}"
                    class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('users.*') ? 'text-purple-600 bg-purple-50 border-l-3 border-purple-500' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50 border-l-3 border-transparent hover:border-purple-500' }} transition-all duration-200">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-purple-500' : 'text-gray-400 group-hover:text-purple-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span>Gestión de Usuarios</span>
                </a>
            @endif
        </div>

        <!-- Separador -->
        <div class="mx-0 my-6">
            <div class="border-t border-gray-200"></div>
        </div>

        <!-- Sección de Estadísticas -->
        <div class="pt-3 pb-6">
            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 px-3">
                Estadísticas del Sistema
            </h4>
            
            <div class="space-y-2">
                <div class="bg-blue-50 border border-blue-100 px-4 py-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-700">Adultos Mayores</span>
                        </div>
                        <span class="text-lg font-bold text-blue-600">{{ \App\Models\AdultoMayor::count() }}</span>
                    </div>
                    <div class="mt-2 text-xs text-blue-600">Total registrados</div>
                </div>

                @if(auth()->user()->is_admin)
                    <div class="bg-purple-50 border border-purple-100 px-4 py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                <span class="text-sm font-medium text-gray-700">Usuarios Sistema</span>
                            </div>
                            <span class="text-lg font-bold text-purple-600">{{ \App\Models\User::count() }}</span>
                        </div>
                        <div class="mt-2 text-xs text-purple-600">Activos en sistema</div>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</aside>

<!-- Overlay para móvil -->
<div class="lg:hidden fixed inset-0 bg-gray-600 bg-opacity-75 z-30 hidden" id="sidebar-overlay"></div>

<!-- Botón para abrir sidebar en móvil -->
<button onclick="toggleSidebar()" class="lg:hidden fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg z-40">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('aside');
    const overlay = document.getElementById('sidebar-overlay');
    
    if (sidebar && overlay) {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
}

// Cerrar sidebar al hacer click en overlay
document.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'sidebar-overlay') {
        const sidebar = document.querySelector('aside');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }
});
</script>