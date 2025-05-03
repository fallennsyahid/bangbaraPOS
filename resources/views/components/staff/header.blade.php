<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>BangbaraPost - Staff</title>
    <link rel="shortcut icon" href="{{ asset('asset-view/assets/png/logo_bangbara.png') }}" type="image/x-icon">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Euphoria+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" /> --}}

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
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

        .input-number::-webkit-inner-spin-button,
        .input-number::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;

        }
    </style>
</head>
