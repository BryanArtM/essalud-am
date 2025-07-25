<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Programa del Adulto Mayor</title>
    <link rel="icon" href="{{ asset('images/icon.jpg') }}" type="image/jpg">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased">
    <main class="py-4">
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
