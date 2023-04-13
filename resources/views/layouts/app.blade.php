<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shifft Marketplace') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <script src="{{ asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link href="https://unpkg.com/treeflex/dist/css/treeflex.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* .example .tf-nc {
        }

        .tf-custom .tf-nc:before,
        .tf-custom .tf-nc:after {
        }

        .tf-custom li li:before {
        } */
        .alert {
            color: white;
            font-weight: bold;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .bg-label-success {
            background-color: #5cb85c;
        }

        .bg-label-warning {
            background-color: #f0ad4e;
        }


        .bg-label-danger {
            background-color: #e61616;
        }

        .bg-label-default {
            background-color: #999;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
