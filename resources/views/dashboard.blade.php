<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Overlay para móvil -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

        <!-- Menú lateral -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-4 border-b flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">Menú</h1>
                <!-- Botón cerrar para móvil -->
                <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded hover:bg-gray-200 text-sm lg:text-base transition-colors">
                    <span class="inline-block w-6 text-center mr-3">🏠</span>Inicio
                </a>
                <a href="{{ route('adultos.index') }}" class="block px-4 py-3 rounded hover:bg-gray-200 text-sm lg:text-base transition-colors">
                    <span class="inline-block w-6 text-center mr-3">📋</span>Adultos Mayores
                </a>
                <a href="{{ route('adultos.create') }}" class="block px-4 py-3 rounded hover:bg-gray-200 text-sm lg:text-base transition-colors">
                    <span class="inline-block w-6 text-center mr-3">➕</span>Nuevo Registro
                </a>
                @if(auth()->user()->is_admin)
                <a href="{{ route('users.index') }}" class="block px-4 py-3 rounded hover:bg-gray-200 text-sm lg:text-base transition-colors">
                    <span class="inline-block w-6 text-center mr-3">👥</span>Usuarios
                </a>
                @endif
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 lg:ml-0">
            <!-- Header móvil con botón hamburguesa -->
            <header class="lg:hidden bg-white shadow-sm border-b px-4 py-3 flex items-center justify-between">
                <button id="open-sidebar" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-800">Dashboard</h1>
                <div class="w-6"></div> <!-- Spacer para centrar el título -->
            </header>

            <!-- Contenido -->
            <div class="p-4 lg:p-6">
                <h1 class="text-xl lg:text-2xl font-bold mb-4 lg:mb-6 capitalize">
                    Bienvenido, {{ Auth::user()->name }}
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                    <!-- Card: Consultar Adulto Mayor -->
                    <a href="{{ route('adultos.index') }}"
                        class="bg-white p-4 lg:p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-2">
                            <span class="text-2xl mr-3">📋</span>
                            <h2 class="text-base lg:text-lg font-semibold text-gray-800">Consultar Adulto Mayor</h2>
                        </div>
                        <p class="text-sm lg:text-base text-gray-600">Busca y visualiza información completa de los beneficiarios.</p>
                    </a>

                    <!-- Card: Registrar Nuevo -->
                    <a href="{{ route('adultos.create') }}"
                        class="bg-white p-4 lg:p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-2">
                            <span class="text-2xl mr-3">➕</span>
                            <h2 class="text-base lg:text-lg font-semibold text-gray-800">Registrar Nuevo</h2>
                        </div>
                        <p class="text-sm lg:text-base text-gray-600">Agrega una nueva ficha para un adulto mayor.</p>
                    </a>

                    @if(auth()->user()->is_admin)
                    <!-- Card: Gestión de Usuarios (solo admin) -->
                    <a href="{{ route('users.index') }}"
                        class="bg-white p-4 lg:p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center mb-2">
                            <span class="text-2xl mr-3">👥</span>
                            <h2 class="text-base lg:text-lg font-semibold text-gray-800">Gestión de Usuarios</h2>
                        </div>
                        <p class="text-sm lg:text-base text-gray-600">Administra usuarios y permisos del sistema.</p>
                    </a>
                    @endif

                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript para el menú móvil -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            openBtn.addEventListener('click', openSidebar);
            closeBtn.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Cerrar sidebar al hacer click en un enlace (móvil)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 1024) { // lg breakpoint
                        closeSidebar();
                    }
                });
            });

            // Cerrar sidebar al redimensionar a desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
            });
        });
    </script>
</x-app-layout>