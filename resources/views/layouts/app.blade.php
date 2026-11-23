{{-- Classic layout used with @extends('layouts.app') (Course pages and the Week 1 static pages).
     It shares the same navbar, alert and footer components as <x-layouts.app>. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') | Training Institute</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <x-navbar />

    <main class="container">
        <x-alert />

        @yield('content')
    </main>

    <x-footer />
</body>
</html>
