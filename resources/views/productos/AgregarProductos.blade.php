<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-size: 15px">
            {!! trans('sistema.agregarProducto') !!}
        </h2>


    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                @if($errors->productos->any())
                    *******************
                    @foreach($errors->productos->errors as $p)
                        {{$p}}
                    @endforeach
                @endif


                    <form id="formProd" >
                        @method('post')
                        @csrf

                        <div class="row ">
                            <input type="text"
                                   name="idProd"
                                   id="idProd"
                                   class="form-control"
                                   maxlength="100"
                                   value="{{old('id', $prod['id'])}}"
                                    hidden
                                   >
                            <div class="col-6">
                                <label for="sku"> {!! trans('sistema.sku') !!} </label>
                                <input type="text"
                                       name="sku"
                                       id="sku"
                                       class="form-control"
                                       maxlength="100"
                                       value="{{old('sku', $prod['sku'])}}"
                                       placeholder="{!! trans('sistema.sku') !!}" required><br>

                                <label for="precioDolares">{!! trans('sistema.precioDolares') !!}</label>
                                <input type="Number"
                                       name="precioDolares"
                                       id="precioDolares"
                                       class="form-control"
                                       maxlength="100"
                                       value="{{old('precioDolares', $prod['precioDolares'])}}"
                                       placeholder=' {!! trans('sistema.precioDolares') !!} ' required><br>



                                <div class="card">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingThree" style="background-color: cadetblue; color: #ffffff">
                                            <div class="card-header">

                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                                    <span>{!! trans('sistema.detalleCabecera') !!}</span>
                                                </button>

                                            </div>
                                        </h2>
                                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingThree">
                                            <div class="accordion-body">
                                                <div class="card-body">
                                                    <label for="nombre">{!! trans('sistema.nombre') !!}</label>
                                                    <input type="text"
                                                           name="nombreEs"
                                                           id="nombreEs"
                                                           class="form-control validacion"
                                                           maxlength="100"
                                                           value="{{old('nombreEs', $prod['nombreEs'])}}"
                                                           onblur="armarUrlEs()"
                                                           placeholder="{!! trans('sistema.nombre') !!}"
                                                           required
                                                    ><br>

                                                    <label for="descripcionCortaEs">{!! trans('sistema.descripcionCorta') !!}</label>
                                                    <input type="text"
                                                           name="descripcionCortaEs"
                                                           id="descripcionCortaEs"
                                                           class="form-control"
                                                           maxlength="100"
                                                           value="{{old('descripcionCortaEs', $prod['descripcionCortaEs'])}}"
                                                           placeholder="{!! trans('sistema.descripcionCorta') !!}" required><br>

                                                    <label for="descripcionLargaEs">{!! trans('sistema.descripcionLarga') !!}</label>
                                                    <input type="text"
                                                           name="descripcionLargaEs"
                                                           id="descripcionLargaEs"
                                                           class="form-control"
                                                           maxlength="100"
                                                           value="{{old('descripcionLargaEs', $prod['descripcionLargaEs'])}}"
                                                           placeholder="{!! trans('sistema.descripcionLarga') !!}" ><br>

                                                    <input type="text"
                                                           name="urlEs"
                                                           id="urlEs"
                                                           value="{{old('urlEs', $prod['urlEs'])}}"
                                                           hidden
                                                           class="form-control"
                                                           maxlength="100"><br>
                                                </div>
                                            </div>
                                        </div>
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
                                       value="{{old('puntos', $prod['puntos'])}}"
                                       placeholder="{!! trans('sistema.puntos') !!}" required><br>

                                <label for="precioPesos">{!! trans('sistema.precioPesos') !!}</label>
                                <input type="Number"
                                       name="precioPesos"
                                       id="precioPesos"
                                       class="form-control"
                                       maxlength="100"
                                       value="{{old('precioPesos', $prod['precioPesos'])}}"
                                       placeholder="{!! trans('sistema.precioPesos') !!}" required><br>



                                <div class="card">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo" style="background-color: cadetblue; color: #ffffff">
                                        <div class="card-header">

                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                                        aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo" >
                                                    <span>{!! trans('sistema.detalleCabecera2') !!}</span>
                                                </button>

                                        </div>
                                        </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <div class="card-body">
                                            <label for="nombre">{!! trans('sistema.nombre') !!}</label>
                                            <input type="text"
                                                   name="nombreEn"
                                                   id="nombreEn"
                                                   onblur="armarUrlEn()"
                                                   class="form-control validacion"
                                                   maxlength="100"
                                                   value="{{old('nombreEn', $prod['nombreEn'])}}"
                                                   placeholder="{!! trans('sistema.nombre') !!}" required><br>

                                            <label for="descripcionCortaEn">{!! trans('sistema.descripcionCorta') !!}</label>
                                            <input type="text"
                                                   name="descripcionCortaEn"
                                                   id="descripcionCortaEn"
                                                   class="form-control"
                                                   maxlength="100"
                                                   value="{{old('descripcionCortaEn', $prod['descripcionCortaEn'])}}"
                                                   placeholder="{!! trans('sistema.descripcionCorta') !!}" required><br>

                                            <label for="descripcionLargaEn">{!! trans('sistema.descripcionLarga') !!}</label>
                                            <input type="text"
                                                   name="descripcionLargaEn"
                                                   id="descripcionLargaEn"
                                                   class="form-control"
                                                   maxlength="100"
                                                   value="{{old('descripcionLargaEn', $prod['descripcionLargaEn'])}}"
                                                   placeholder="{!! trans('sistema.descripcionLarga') !!}" ><br>

                                            <input type="text"
                                                   name="urlEn"
                                                   id="urlEn"
                                                   value="{{old('urlEn', $prod['urlEn'])}}"
                                                   hidden
                                                   class="form-control"
                                                   maxlength="100"><br>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                </div>



                            </div>
                        </div>
                        <p></p>

                        <div class="d-grid col-6 mx-auto">
                            @if($prod['puntos'] === null)
                                <button type="button" id="guardar" class="btn btn-success" > Guardar</button>
                            @else
                                <button type="button" id="editar" class="btn btn-warning" > Editar</button>
                            @endif

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

        let urlEn = nombreEn+"-en"

        document.getElementById("urlEn").value = urlEn;
        return urlEn;
    }

    function armarUrlEs() {
        let nombreEs = document.getElementById('nombreEs').value;

        let urlEs = nombreEs + "-es"

        document.getElementById("urlEs").value = urlEs;
        return urlEs;
    }





    var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $(document).ready( function () {
        $(document).on('click', '#guardar', function () {
            console.log("Hacemos algo ?? ")
            metodo.probar();
        });

    });

var metodo = {
    probar:function () {


        Swal.fire({
            //title: '¿Esta seguro?',
            text: "¿Esta seguro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Guardar',
            cancelButtonText: 'No estoy seguro/a'
        }).then((result) => {
            if (result.isConfirmed) {

                axios.post("{{route('guardar')}}",
                    {
                        sku: document.getElementById('sku').value,
                        puntos: document.getElementById('puntos').value,
                        precioDolares: document.getElementById('precioDolares').value,
                        precioPesos: document.getElementById('precioPesos').value,
                        nombreEs: document.getElementById('nombreEs').value,
                        descripcionCortaEs: document.getElementById('descripcionCortaEs').value,
                        descripcionLargaEs: document.getElementById('descripcionLargaEs').value,
                        urlEs: document.getElementById('urlEs').value,
                        nombreEn: document.getElementById('nombreEn').value,
                        descripcionCortaEn: document.getElementById('descripcionCortaEn').value,
                        descripcionLargaEn: document.getElementById('descripcionLargaEn').value,
                        urlEn: document.getElementById('urlEn').value,
                    }
                ).then(res => {
                    window.location = "{{url('dashboard')}}"
                    Swal.fire({
                        icon: "success",
                        title: "Se guardó correctamente",
                        showConfirmButton: false,
                        timer: 2500,
                    });
                    var message = response.data.message
                        ? response.data.message
                        : "Se actualizó correctamente el registro";
                    miniToastr.success(message);

                })
                    .catch(function (error) {
                    console.log(error.response, "response Guardar")
                    if (error.response.status === 422) {
                        console.log(error.response.data.errors);
                    }
                })
            }
            })
        }

    }


    $(document).ready(() => {
        $(document).on("keyup", '#precioDolares', function () {
            axios.post("{{route('conversionPesos')}}", {precio: $("#precioDolares").val()}).then(res => {
                $("#precioPesos").val(res.data)
            })
        });
        $(document).on("keyup", '#precioPesos', function () {
            axios.post("{{route('conversionDolar')}}", {precio: $("#precioPesos").val()}).then(res => {
                $("#precioDolares").val(res.data)
            })
        });
    });



    $(document).ready( function () {
        $(document).on('click', '#editar', function () {
            console.log("Entramos a editar ")
            metodoEditar.editar();
        });

    });

    var metodoEditar = {
        editar:function () {

            const param = {

            }


            Swal.fire({
                //title: '¿Esta seguro?',
                text: "¿Los datos son correctos?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Guardar',
                cancelButtonText: 'No estoy seguro/a'
            }).then((result) => {
                if (result.isConfirmed) {

                    axios.post("{{route('guardarEdicion')}}",
                        {
                            sku: document.getElementById('sku').value,
                            idProducto: document.getElementById('idProd').value,
                            puntos: document.getElementById('puntos').value,
                            precioDolares: document.getElementById('precioDolares').value,
                            precioPesos: document.getElementById('precioPesos').value,
                            nombreEs: document.getElementById('nombreEs').value,
                            descripcionCortaEs: document.getElementById('descripcionCortaEs').value,
                            descripcionLargaEs: document.getElementById('descripcionLargaEs').value,
                            urlEs: document.getElementById('urlEs').value,
                            nombreEn: document.getElementById('nombreEn').value,
                            descripcionCortaEn: document.getElementById('descripcionCortaEn').value,
                            descripcionLargaEn: document.getElementById('descripcionLargaEn').value,
                            urlEn: document.getElementById('urlEn').value,
                        }
                    ).then(res => {
                        Swal.fire({
                            icon: "success",
                            title: "Se guardó correctamente",
                            showConfirmButton: false,
                            timer: 2500,
                        });
                        var message = response.data.message
                            ? response.data.message
                            : "Se actualizó correctamente el registro";
                        miniToastr.success(message);
                        window.location = "{{url('/dashboard')}}"

                    }).catch(function (error) {
                        console.log(error.response, "response**")
                        if (error.response.status === 422) {
                            console.log(error.response.data.errors);

                        }
                    })
                }
            })
        }

    }





    jQuery('.validacion').keypress(function (tecla) {
        console.log(tecla. charCode)
        if ((tecla.charCode == 241 || tecla.charCode == 39)) return false;
    });

</script>
