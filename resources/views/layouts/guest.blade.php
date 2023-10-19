<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">

        <div class="min-h-screen flex flex-col  items-center pt-6 sm:pt-0 bg-gray-100">
            <br/>
            <button onclick="location.href='{{ url('detalleProducto') }}'" type="button" class="btn btn-sm btn-outline-warning"
            style="color: #ffffff;
    background: cadetblue;
    width: 325px;
    height: 32px; border-radius: 5px;position: absolute; top: 8px">
                {!! trans('sistema.productos') !!}
                <i class="fa-brands fa-product-hunt"></i>
            </button>




            @if(App::getLocale() == 'es')
                <a style="text-decoration:none;color: #ffffff;
                        background: #413b3b;
                        width: 134px;
                        height: 27px; border-radius: 5px;position: absolute; top: 49px; right: 459px"

                   type="button"
                   href="{{url('/cambiar/idioma?idioma=en')}}" >
                    <span>  {!! trans('sistema.idioma') !!}</span>
                    <i class="fa-solid fa-earth-americas"></i>
                </a>

            @else
                <a style="text-decoration:none;color: #ffffff;
                        background: #413b3b;
                        width: 134px;
                        height: 27px; border-radius: 5px;position: absolute; top: 49px; right: 459px"
                   type="button"
                   href="{{url('/cambiar/idioma?idioma=es')}}" >

                    <span> {!! trans('sistema.idioma') !!}</span>
                    <i class="fa-solid fa-earth-americas"></i>
                </a>
            @endif









            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}

            </div>
        </div>
    </body>
</html>
