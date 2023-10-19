<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-size: 15px">
            {!! trans('sistema.productos') !!}
        </h2>
        <a
           type="button"
           class="btn btn-sm btn-info"
           style="position: absolute; top: 89px; left: 85%; text-decoration: none; background: cadetblue;color: #ffff;"
           href="{{route('agregar')}}"
           data-bs-toggle="tooltip" data-bs-placement="top"
           title="{!! trans('sistema.agregarProducto') !!}">
            <i class="fa-solid fa-plus"></i>
        </a>
    </x-slot>



    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table id="myTable" class="display" style="border: 1px solid #00000078;top: 3px; position: relative;">
                        <thead style="background: #5F9EA0FF; color: #ffffff">
                        <tr>
                            <th>Id</th>
                            <th>{!! trans('sistema.sku') !!}</th>
                            <th>{!! trans('sistema.nombre') !!}</th>
                            <th>{!! trans('sistema.precioDolares') !!}</th>
                            <th>{!! trans('sistema.precioPesos') !!}</th>
                            <th>{!! trans('sistema.puntos') !!}</th>
                            <th>{!! trans('sistema.activo') !!}</th>
                            <th>{!! trans('sistema.acciones') !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($productos as $prod)
                        <tr>
                            <td>{{$prod->id_producto}}</td>
                            <td>{{$prod->sku}}</td>
                            <td style="font-weight: bold">{{$prod->nombre}}</td>
                            <td style="color: #2a7520 ">${{$prod->precio_dolares}}</td>
                            <td style="color: #70326b ">${{$prod->precio_pesos}}</td>
                            <td>{{$prod->puntos}}</td>
                            @if($prod->registro_activo === 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            <td>
                             <!--   <a href="{{ route('obtenerDetalle', [app()->getLocale(),  $prod->url]) }}">Link to home with lang</a>-->
                                <a
                                    id="detalle"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="Ver detalle"
                                    href="{{ route('obtenerDetalle',  [$prod->url] ) }}"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a
                                    href="{{url('admin/editar').'/'.$prod->id_producto}}"
                                    type="button"
                                    class="btn btn-sm btn-outline-warning"
                                    title="Editar"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button
                                    id="eliminar"
                                    type="submit"
                                    onclick="eliminarInactivar({{$prod->id_producto}})"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Eliminar/Inactivar"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>





    /* Initialization of datatables */
    $(document).ready(function () {
        $('table.display').DataTable();
    });



    function eliminarInactivar(id){
        Swal.fire({
            title: '¿Desea eliminar o inactivar el empleado?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Inactivar',
            denyButtonText: `Eliminar`,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                Swal.fire({
                    //title: '¿Esta seguro?',
                    text: "El registro se inactivará",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'De acuerdo',
                    cancelButtonText: 'No estoy seguro/a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //Inactivar
                        axios.put("{{  route('inactivar')}}", {id}).then((response) => {
                            console.log(response.data);
                            window.location = "{{url('dashboard')}}"
                            Swal.fire('Elemento Inactivado', '', 'success')

                        });
                    }

                })








            } else if (result.isDenied) {
                Swal.fire({
                    //title: '¿Esta seguro?',
                    text: "El registro quedará eliminado, la acción no se podrá revertir",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'De acuerdo',
                    cancelButtonText: 'No estoy seguro/a'
                }).then((result) => {
                    if(result.isConfirmed){
                        //Eliminar
                        axios.put( "{{  route('eliminar')}}", {id} ).then((response) => {
                            console.log(response.data);
                            window.location = "{{url('dashboard')}}"
                            Swal.fire('Elemento Eliminado', '', 'success')

                        });
                    }


                })
            }
        })
    }


</script>
<style>
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #aaa;
        border-radius: 3px;
        padding: 5px;
        background-color: transparent;
        color: inherit;
        padding: 4px;
        width: 45%;
    }
</style>
