<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icons/favicon-32x32.png') }}">
    <link href="{{ asset('assets/library/bootstrap/bootstrap.min.css')  }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/library/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')
</head>
<body class="bg-mailerlite d-flex flex-column h-100">
    @include('components.navbar')

    <main class="flex-shrink-0">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('components.footer')

    <script src="{{ asset('assets/library/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/library/jquery/jquery3.6.min.js') }}"></script>
    <script src="{{ asset('assets/library/toastr/toastr.min.js') }}"></script>

    @include('components.messages.session-with-toast')
    @stack('scripts')
</body>
</html>
