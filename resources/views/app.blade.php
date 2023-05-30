<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="/dist/libs/dropzone/dist/min/dropzone.min.css">
        <link href="/dist/css/style.css" rel="stylesheet" />
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia 
        <script src="/dist/libs/jquery/dist/jquery.min.js"></script>
        <script src="/dist/libs/dropzone/dist/min/dropzone.min.js"></script>
    </body>
</html>
