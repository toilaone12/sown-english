<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sown English</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('be/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('be/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('be/css/style.css') }}" />
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    {{-- Swalalert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
</head>
@php
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Cookie;
@endphp

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.sidebar')
        <!--  Sidebar End -->
        @include('admin.content')
        <!--  Main wrapper -->
    </div>
    @include('admin.script')
</body>

</html>
