<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        @yield('title') - myDiscography
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body style="background-image: url('{{ asset('assets/img/elvis-presley-1482026_1280.jpg') }}')">
    @include('layouts._partials.navigation')
    <div class="content">
        @yield('content')
    </div>
    @include('layouts._partials.footer')
    @stack('scripts')
</body>

</html>
