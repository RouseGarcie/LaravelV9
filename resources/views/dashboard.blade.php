<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! trans('sistema.productos') !!}
        </h2>
        <a
           type="button"
           class="btn btn-sm btn-info"
           style="position: absolute; top: 89px; left: 85%; text-decoration: none"
           href="{{route('agregar')}}"
           data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar productos">
            <i class="fa-solid fa-plus"></i>
        </a>
    </x-slot>



    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table id="myTable" class="display">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>{!! trans('sistema.sku') !!}</th>
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
                            <td>{{$prod->id}}</td>
                            <td>{{$prod->sku}}</td>
                            <td>{{$prod->precio_dolares}}</td>
                            <td>{{$prod->precio_pesos}}</td>
                            <td>{{$prod->puntos}}</td>
                            @if($prod->registro_activo === 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            <td>
                                <button
                                    id="detalle"
                                    type="button"
                                    class="btn btn-sm btn-outline-success"
                                    title="Ver detalle"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"

                                >
                                    <i class="fa-regular fa-eye"></i>
                                </button>

                                <a
                                    href="{{url('editar').'/'.$prod->id}}"
                                    type="button"
                                    class="btn btn-sm btn-outline-warning"
                                    title="Editar"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button
                                    id="eliminar"
                                    type="submit"
                                    onclick="eliminarInactivar({{$prod->id}})"
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




                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   ************
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <!--<button type="button" class="btn btn-primary">Save changes</button> -->
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
    /* Initialization of datatables */
    $(document).ready(function () {
        $('table.display').DataTable();
    });
</script>
