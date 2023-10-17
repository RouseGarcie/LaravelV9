<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-size: 14px">
            {!! trans('sistema.agregarProducto') !!}
        </h2>


    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <form id="formProd" method="post" action="{{url('admin/producto/guardar')}}">
                        @method('post')
                        @csrf

                        <div class="row ">
                            <div class="col-6">
                                <label for="sku"> {!! trans('sistema.sku') !!} </label>
                                <input type="text"
                                       name="sku"
                                       id="sku"
                                       class="form-control"
                                       maxlength="100"
                                       placeholder="{!! trans('sistema.sku') !!}" required><br>

                                <label for="precioDolares">{!! trans('sistema.precioDolares') !!}</label>
                                <input type="Number"
                                       name="precioDolares"
                                       id="precioDolares"
                                       class="form-control"
                                       maxlength="100"
                                       placeholder=' {!! trans('sistema.precioDolares') !!} ' required><br>

                                <div class="card">
                                    <div class="card-header">
                                        <span> {!! trans('sistema.detalleCabecera') !!}          </span>
                                    </div>
                                    <div class="card-body">
                                        <label for="nombre">{!! trans('sistema.nombre') !!}</label>
                                        <input type="text"
                                               name="nombreEs"
                                               id="nombreEs"
                                               class="form-control validacion"
                                               maxlength="100"
                                               onblur="armarUrlEs()"
                                               placeholder="{!! trans('sistema.nombre') !!}"
                                               required
                                        ><br>

                                        <label for="nombre">{!! trans('sistema.descripcionCorta') !!}</label>
                                        <input type="text"
                                               name="descripcionCortaEs"
                                               id="descripcionCortaEs"
                                               class="form-control"
                                               maxlength="100"
                                               placeholder="{!! trans('sistema.descripcionCorta') !!}" required><br>

                                        <label for="nombre">{!! trans('sistema.descripcionLarga') !!}</label>
                                        <input type="text"
                                               name="descripcionLargaEs"
                                               id="descripcionLargaEs"
                                               class="form-control"
                                               maxlength="100"
                                               placeholder="{!! trans('sistema.descripcionLarga') !!}" ><br>

                                        <input type="text"
                                               name="urlEs"
                                               id="urlEs"
                                               hidden
                                               class="form-control"
                                               maxlength="100"><br>
                                    </div>
                                </div>


                            </div>

                            <div class="col-6 ">
                                <label for="puntos">{!! trans('sistema.puntos') !!}</label>
                                <input type="Number"
                                       name="puntos"
                                       id="puntos"
                                       class="form-control"
                                       maxlength="100"
                                       min="0"
                                       placeholder="{!! trans('sistema.puntos') !!}" required><br>

                                <label for="precioPesos">{!! trans('sistema.precioPesos') !!}</label>
                                <input type="Number"
                                       name="precioPesos"
                                       id="precioPesos"
                                       class="form-control"
                                       maxlength="100"
                                       placeholder="{!! trans('sistema.precioPesos') !!}" required><br>


                                <div class="card">
                                    <div class="card-header">
                                        <span>{!! trans('sistema.detalleCabecera2') !!}</span>
                                    </div>
                                    <div class="card-body">
                                        <label for="nombre">{!! trans('sistema.nombre') !!}</label>
                                        <input type="text"
                                               name="nombreEn"
                                               id="nombreEn"
                                               onblur="armarUrlEn()"
                                               class="form-control validacion"
                                               maxlength="100"
                                               placeholder="{!! trans('sistema.nombre') !!}" required><br>

                                        <label for="nombre">{!! trans('sistema.descripcionCorta') !!}</label>
                                        <input type="text"
                                               name="descripcionCortaEn"
                                               id="descripcionCortaEn"
                                               class="form-control"
                                               maxlength="100"
                                               placeholder="{!! trans('sistema.descripcionCorta') !!}" required><br>

                                        <label for="nombre">{!! trans('sistema.descripcionLarga') !!}</label>
                                        <input type="text"
                                               name="descripcionLargaEn"
                                               id="descripcionLargaEn"
                                               class="form-control"
                                               maxlength="100"
                                               placeholder="{!! trans('sistema.descripcionLarga') !!}" ><br>

                                        <input type="text"
                                               name="urlEn"
                                               id="urlEn"
                                               hidden
                                               class="form-control"
                                               maxlength="100"><br>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <p></p>

                        <div class="d-grid col-6 mx-auto">
                            <button type="submit" class="btn btn-success"  > Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function armarUrlEn() {
        let nombreEn = document.getElementById('nombreEn').value;

        let urlEn = nombreEn+"/en"

        document.getElementById("urlEn").value = urlEn;
        return urlEn;
    }

    function armarUrlEs() {
        let nombreEs = document.getElementById('nombreEs').value;

        let urlEs = nombreEs + "/es"

        document.getElementById("urlEs").value = urlEs;
        return urlEs;
    }




    function probar(){



        Swal.fire({
            //title: '¿Esta seguro?',
            text: "¿Esta seguro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Guardar'
        }).then((result) => {
            if (result.isConfirmed) {

                var body = {
                    sku: document.getElementById('sku'),
                }

                axios({
                    method: "post",
                    url: '/admin/producto/guardar',
                    data: body,
                    headers: { "Content-Type": "multipart/form-data" },
                })
                    .then(function (response) {
                        //handle success
                        console.log(response);
                    })
                    .catch(function (response) {
                        //handle error
                        console.log(response);
                    });
            }
        })
    }


    jQuery('.validacion').keypress(function (tecla) {
        console.log(tecla. charCode)
        if ((tecla.charCode == 241 || tecla.charCode == 39)) return false;
    });

</script>
