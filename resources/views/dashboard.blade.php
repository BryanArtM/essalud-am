<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Menú lateral -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-4 border-b">
                <h1 class="text-xl font-bold text-gray-800">Menú</h1>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200">🏠 Inicio</a>
                <a href="{{ route('adultos.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200">📋 Adultos
                    Mayores</a>
                <a href="{{ route('adultos.create') }}" class="block px-4 py-2 rounded hover:bg-gray-200">➕ Nuevo
                    Registro</a>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-bold mb-6">Bienvenido, {{ Auth::user()->name }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card: Consultar Adulto Mayor -->
                <a href="{{ route('adultos.index') }}"
                    class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-800">📋 Consultar Adulto Mayor</h2>
                    <p class="mt-2 text-gray-600">Busca y visualiza información completa de los beneficiarios.</p>
                </a>

                <!-- Card: Registrar Nuevo -->
                <a href="{{ route('adultos.create') }}"
                    class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-800">➕ Registrar Nuevo</h2>
                    <p class="mt-2 text-gray-600">Agrega una nueva ficha para un adulto mayor.</p>
                </a>

            </div>
        </main>

    </div>
</x-app-layout>