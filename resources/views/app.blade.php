<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="FilmXtra">
        <meta name="description" content="Trabajo Final de Grado DAW2 del grupo FilmXtra">
        <meta name="keywords" content="HTML, CSS, JavaScript, VUE, Laravel">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{--Configurado dinámicamente en app.js--}}
        {{--<title></title>--}}

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="/favicon.png" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
