<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>BangbaraPost - Admin</title>
    <link rel="icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" sizes="192x192" type="image/png">
    <link rel="stylesheet" href="{{ asset('asset-view/css/extra.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <style>
        .confirm-button {
            background-color: #b91c1c;
            color: white;
            border: none;
        }

        .confirm-button:hover {
            background-color: #991b1b;
            color: white;
        }

        .cancel-button {
            background-color: #facc15;
            color: white;
            border: none;
        }

        .cancel-button:hover {
            background-color: #fbbf24;
            color: white;
        }
    </style>
</head>
