<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title> 
        <link rel="stylesheet" href="/dist/libs/cropper/dist/cropper.min.css">
        <link href="/dist/css/style.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <!-- para ver iconos -->
        <!-- https://fonts.google.com/icons?selected=Material+Symbols+Outlined:star:FILL@0;wght@400;GRAD@0;opsz@48&icon.platform=web -->
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia 
        <script src="/dist/libs/jquery/dist/jquery.min.js"></script>  
        <script src="/dist/libs/cropper/dist/cropper.min.js"></script>
    </body>
</html>
