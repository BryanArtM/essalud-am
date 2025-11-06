{{-- Sidebar fijo --}}
<aside
    class="fixed left-0 top-0 w-64 h-full bg-gray-800 border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-40 lg:z-40">
    <!-- Header del Sidebar -->
    <div class="px-3 py-3 border-b border-gray-100">
        <h3 class="text-base font-semibold text-white tracking-tight">Panel de Control</h3>
        <p class="text-sm text-gray-300 mt-1">Gestión del sistema</p>
    </div>

    <!-- Navegación Principal -->
    <nav class="px-4 pt-4 overflow-y-auto h-full pb-20">
        <div class="space-y-1">
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-white bg-slate-900 border-l-3 border-blue-400' : 'text-white hover:text-blue-200 hover:bg-gray-700 border-l-3 border-transparent' }} transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v4m8-4v4"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('adultos.index') }}"
                class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('adultos.index') ? 'text-white bg-slate-900 border-l-3 border-sky-400' : 'text-white hover:text-blue-200 hover:bg-gray-700 border-l-3 border-transparent ' }} transition-all duration-200">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="w-5 h-5 mr-3" aria-hidden="true">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                </svg>
                <span>Adultos Mayores</span>
            </a>

            <a href="{{ route('adultos.create') }}"
                class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('adultos.create') ? 'text-white bg-slate-900 border-l-3 border-green-400' : 'text-white hover:text-green-200 hover:bg-gray-700 border-l-3 border-transparent ' }} transition-all duration-200">

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="w-5 h-5 mr-3" aria-hidden="true">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <line x1="19" x2="19" y1="8" y2="14"></line>
                    <line x1="22" x2="16" y1="11" y2="11"></line>
                </svg>

                <span>Nuevo Registro</span>
            </a>

            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.index') }}"
                    class="group flex items-center px-3 py-2.5 text-sm font-medium {{ request()->routeIs('admin.index') ? 'text-white bg-slate-900 border-l-3 border-orange-400' : 'text-white hover:text-orange-200 hover:bg-gray-700 border-l-3 border-transparent ' }} transition-all duration-200">
                    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Administración</span>
                </a>
            @endif
        </div>

        <!-- Separador -->
        <div class="mx-0 my-3">
            <div class="border-t border-gray-200"></div>
        </div>

        <!-- Sección de Estadísticas -->
        <div class="pt-3 pb-6">
            <h4 class="text-xs font-semibold text-white uppercase tracking-wider mb-3 px-3">
                Estadísticas del Sistema
            </h4>

            <div class="space-y-2">
                <div class="bg-cya-950 border border-sky-800 px-4 py-3 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-white">Adultos Mayores</span>
                        </div>
                        <span class="text-lg font-bold text-blue-300">{{ \App\Models\AdultoMayor::count() }}</span>
                    </div>
                    <div class="mt-2 text-xs text-blue-300">Total registrados</div>
                </div>

                @if (auth()->user()->is_admin)
                    <div class="bg-blue-950 border border-blue-800 px-4 py-3 text-white">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                <span class="text-sm font-medium text-white">Usuarios Sistema</span>
                            </div>
                            <span class="text-lg font-bold text-purple-300">{{ \App\Models\User::count() }}</span>
                        </div>
                        <div class="mt-2 text-xs text-purple-300">Activos en sistema</div>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</aside>

<!-- Overlay para móvil -->
<div class="lg:hidden fixed inset-0 bg-gray-600 bg-opacity-75 z-30 hidden" id="sidebar-overlay"></div>

<!-- Botón para abrir sidebar en móvil -->
<button onclick="toggleSidebar()"
    class="lg:hidden fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg z-40">
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
