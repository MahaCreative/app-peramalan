<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
        integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>@yield('title')</title>
    @livewireStyles
</head>

<body>
    <div class="overflow-x-hidden">
        <div
            class="px-14 lg:px-28 pt-8 bg-slate-900 bg-opacity-10 text-white flex lg:gap-x-0 gap-x-5 items-center justify-between shadow-md">
            <div>
                <h3 class="font-bold text-[14pt] lg:text-[24pt]">PredictSales</h3>
            </div>
            <ul class="flex gap-x-8 text-[12pt] lg:text-[16pt] font-light">
                <li><a class="hover:text-blue-600 " href="">Home</a></li>
                {{-- <li><a class="hover:text-blue-600 " href="">Documentation</a></li> --}}

                @guest

                    <button data_link='login'
                        class="hover:text-blue-600 btn transition-all ease-linear duration-300 hover:bg-opacity-70 border rounded-md py-2 px-4  text-white opacity-80 shadow-md
                 shadow-slate-300/50">Login</button>
                    <button data_link='register'
                        class="hover:text-blue-600 btn transition-all ease-linear duration-300 hover:bg-opacity-70 border rounded-md py-2 px-4
                      shadow-md
                 shadow-slate-300/50">Register
                        Your Account</button>
                @else
                    <li><a class="hover:text-blue-600 " href="{{ route('dashboard') }}">Dashboard</a></li>
                @endguest
            </ul>
        </div>
        {{ $slot }}
    </div>
    @stack('js')

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tw.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>


    @livewireScripts()
</body>

</html>
