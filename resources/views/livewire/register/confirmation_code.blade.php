<html lang="es">
<head>
    <meta charset="utf-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Necesario para el funcionamiento de laviwire --}}
    @livewireStyles
</head>
<body>
    <h2 class="c-blue">Hi {{ $Name }}, thank you for register in <strong> Besana</strong> !</h2>
    <p>Please, confirm your email</p>
 

    <a href="{{ url('/register/verify/' . $confirmation_code) }}">
        Click for confirm your email
    </a>


{{-- Necesario para el funcionamiento de laviwire --}}
    @livewireScripts
</body>
</html>