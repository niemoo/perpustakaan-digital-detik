<!--

=========================================================
* Argon Dashboard 2 Tailwind - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/images/book-logo.png') }} " type="image/png" />
    <title>@yield('title') - Digital Library</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/e5c96fca62.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard-tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS Libraries -->
    @stack('customCSS')

</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <!-- sidenav  -->
    @include('dashboard.partials.sidenav')
    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">

        <!-- Navbar -->
        @include('dashboard.partials.navbar')
        <!-- end Navbar -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- cards -->
            @yield('content')
        </div>
        <!-- end cards -->
    </main>
    @include('dashboard.partials.setting')
    <!--   Core JS Files   -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <!--  Sweet Alert  -->
    @include('sweetalert::alert')
    <!-- plugin for scrollbar  -->
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- main script file  -->
    <script src="{{ asset('assets/js/argon-dashboard-tailwind.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JS Libraries -->
    @stack('customJS')
</body>

</html>
