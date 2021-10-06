<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <style>            
            @font-face {
                font-family: 'S-CoreDream-4Regular';
                src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-4Regular.woff') format('woff');
                font-weight: normal;
                font-style: normal;
            }
            *{
                font-family: S-CoreDream-4Regular;
            }
            .bg-logo{
                background-size:100%;
                background-position: 6rem 3rem;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cpath d='M155.8,18.91l23.91,23.91L161.45,61.09,137.53,37.18a8,8,0,1,0-11.29,11.29l23.24,23.24s0,0,0,0l.69.66a33.82,33.82,0,0,1-47.83,47.83c-.22-.23-.45-.46-.66-.69a0,0,0,0,1,0,0L78.42,96.29a8,8,0,0,0-11.29,11.29l23.24,23.24a0,0,0,0,1,0,0c.23.22.46.44.68.67a33.81,33.81,0,0,1-47.82,47.82L19.31,155.41l18.26-18.27,23.91,23.91a8,8,0,1,0,11.3-11.29L49.53,126.52h0l-.69-.66A33.82,33.82,0,0,1,96.69,78c.22.22.45.45.66.68h0l23.24,23.24a8,8,0,0,0,11.29-11.29L108.65,67.41h0c-.23-.21-.46-.44-.68-.66A33.82,33.82,0,0,1,155.8,18.91Z' fill='%23F3F4F6'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
            }
            .bg-logo-item{
                background-size:100%;
                background-position: 3rem -2rem;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cpath d='M155.8,18.91l23.91,23.91L161.45,61.09,137.53,37.18a8,8,0,1,0-11.29,11.29l23.24,23.24s0,0,0,0l.69.66a33.82,33.82,0,0,1-47.83,47.83c-.22-.23-.45-.46-.66-.69a0,0,0,0,1,0,0L78.42,96.29a8,8,0,0,0-11.29,11.29l23.24,23.24a0,0,0,0,1,0,0c.23.22.46.44.68.67a33.81,33.81,0,0,1-47.82,47.82L19.31,155.41l18.26-18.27,23.91,23.91a8,8,0,1,0,11.3-11.29L49.53,126.52h0l-.69-.66A33.82,33.82,0,0,1,96.69,78c.22.22.45.45.66.68h0l23.24,23.24a8,8,0,0,0,11.29-11.29L108.65,67.41h0c-.23-.21-.46-.44-.68-.66A33.82,33.82,0,0,1,155.8,18.91Z' fill='%23F3F4F6'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
            }
        </style>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!--Font Awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

        <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
        <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
        
        <!-- Kakao Map -->
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=070ab20adcdb9a7b504725820ffd152c"></script> 
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-logo">
            @livewire('navigation-menu')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="px-4">
                {{ $slot }}
            </main>
        </div>
        <div>
            푸터가 요기잉네
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
