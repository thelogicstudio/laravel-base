<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <link rel="icon" href="{{asset('images/logo.svg')}}" type="image/x-icon">
        <link rel="shortcut icon" href="{{asset('images/logo.svg')}}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" type="text/css" href="{{assetVersioned('css/variables.css')}}">
        <link rel="stylesheet" type="text/css" href="{{assetVersioned('css/color-2.css')}}">
        <link rel="stylesheet" type="text/css" href="{{assetVersioned('css/icofont.css')}}">
        <link rel="stylesheet" type="text/css" href="{{assetVersioned('css/themify.css')}}">
        <link rel="stylesheet" type="text/css" href="{{assetVersioned('css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{assetVersioned('css/responsive.css')}}">
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <img class="img-fluid" src="{{asset('images/logo.svg')}}" alt="" style="height: 100px;">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
