<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
        integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>@yield('title')</title>
    @livewireStyles
</head>

<body>
    <div class="flex">
        @livewire('snippets.sidebar')
        <div class="ml-24 md:ml-44 lg:ml-72 w-full">
            {{ $slot }}
        </div>
    </div>


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tw.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
        });
        window.addEventListener('swal:modal', event => {
            Toast.fire({
                icon: event.detail.type,
                title: event.detail.title,

            });
        })
    </script>
    @stack('scripts')
    @livewireScripts



</body>

</html>
