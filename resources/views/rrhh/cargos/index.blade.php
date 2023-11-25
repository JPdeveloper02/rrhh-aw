@extends('adminlte::page')

@section('title', 'Listado Personal')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h2><b>LISTADO DE CARGOS</b></h2>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#nuevoCargoModal">Nuevo cargo <i class="fas fa-plus-square"></i></button>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <th class="align-middle text-center" rowspan="2">#</th>
                        <th class="align-middle text-center" rowspan="2">Nombre de Cargo</th>
                        <th class="align-middle text-center" colspan="2">Acciones</th>
                    </tr>
                    <tr>
                        <th class="text-center p-1">Editar</th>
                        <th class="text-center p-1">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cargos as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($item->NombreCargo) }}</td>
                        <td>
                            <button class="btn btn-success btn-sm editar-cargo" data-toggle="modal" data-target="#editarCargoModal" data-nombre="{{ $item->NombreCargo }}" data-id="{{ $item->idCargo }}"><i class="fas fa-edit"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm btn-eliminar-cargo" data-id="{{ $item->idCargo }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('rrhh.cargos.modales.editar_cargo')
    @include('rrhh.cargos.modales.nuevo_cargo')
@stop

@section('js')
    <script src="{{asset('js/cargos/cargos.js')}}"></script>
    <script>
        //Rutas para ajax
        const verPersonaUrl = '{{ route("verPersona") }}';
        //TOKEN CSRF
        const csrfToken = "{{ csrf_token() }}";
    </script>
@stop