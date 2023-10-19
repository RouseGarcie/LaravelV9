<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laravel</title>

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <div style="position: relative; left: -40px;">
            <button onclick="location.href='{{ url('login') }}'" class="btn btn-outline-secondary">
                {!! trans('sistema.aSesion') !!}
            </button>
        </div>

        <a class="navbar-brand" >{!! trans('sistema.detalleProd') !!}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                <li class="nav-item"><a class="nav-link" href="#!"></a></li>
                <li class="nav-item dropdown">
                    <a  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                @if(App::getLocale() == 'es')
                    <a style="text-decoration: none;color: #1a1919;"

                       type="button"
                       href="{{url('/cambiar/idioma?idioma=en')}}" >
                        <span>  {!! trans('sistema.idioma') !!}</span>
                        <i class="fa-solid fa-earth-americas"></i>
                    </a>

                @else
                    <a style="text-decoration: none;color: #0c0c0c"
                       type="button"
                       href="{{url('/cambiar/idioma?idioma=es')}}" >

                        <span> {!! trans('sistema.idioma') !!}</span>
                        <i class="fa-solid fa-earth-americas"></i>
                    </a>
                @endif





            </form>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-dark py-3">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">{!! trans('sistema.cabeceraExterna') !!}</h1>
            <p class="lead fw-normal text-white-50 mb-0">{!! trans('sistema.textoCabecera') !!}</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                @php $i=1; @endphp
                @foreach($productos as $prod)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{asset('assets/laravel-9.png')}}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$prod->nombre}} (<code>{{$prod->sku}}</code>)</h5>
                                <!-- Product price-->
                                <label>Precio Dolar: <code> ${{$prod->precio_dolares}}</code></label>
                                <label>Precio Pesos: <code> ${{$prod->precio_pesos}}</code></label>
                            </div>
                        </div>
                        <!-- Product actions-->
                       <!-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                        </div> -->
                    </div>
                </div>
                @endforeach



        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Rouse 2023 &copy; Ya casi termino :)</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
