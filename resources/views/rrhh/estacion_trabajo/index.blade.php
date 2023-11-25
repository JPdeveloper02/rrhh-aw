@extends('adminlte::page')

@section('title', 'Listado Personal')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h2><b>LISTADO ESTACIONES DE TRABAJO</b></h2>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#nuevaEstacionModal">Nuevo estación <i class="fas fa-plus-square"></i></button>
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
                        <th class="align-middle text-center" rowspan="2">Nombre de estación</th>
                        <th class="align-middle text-center" rowspan="2">Regimen</th>
                        <th class="align-middle text-center" rowspan="2">Estado</th>
                        <th class="align-middle text-center">Acciones</th>
                    </tr>
                    <tr>
                        <th class="text-center p-1">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estaciones as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($item->NombreEstacionDeTrabajo) }}</td>
                        <td>
                            <select class="form-control select-regimen" data-idestacion="{{ $item->idEstacionDeTrabajo }}" name="regimen" id="">
                                @foreach ($regimen as $reg)
                                    <option value="{{ $reg->idRegimenLaboral }}" {{ $reg->idRegimenLaboral == $item->idRegimenLaboral ? 'selected' : '' }}>{{ $reg->tipo }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control select-estado" data-idestacion="{{ $item->idEstacionDeTrabajo }}" name="estado" id="estado">
                                <option value="1" {{ $item->estado == 1 ? 'selected' : '' }}>ACTIVO</option>
                                <option value="2" {{ $item->estado == 2 ? 'selected' : '' }}>INACTIVO</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-eliminar-estacion" data-id="{{ $item->idEstacionDeTrabajo }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@include('rrhh.estacion_trabajo.modales.nueva_estacion')
@section('js')
    <script src="{{asset('js/estacion_trabajo/estacion_trabajo.js')}}"></script>
    <script>
        //Rutas para ajax
        const url_estado = '{{ route("editar.estado") }}';
        const url_regimen = '{{ route("editar.regimen") }}';
        //TOKEN CSRF
        const csrfToken = "{{ csrf_token() }}";
    </script>
@stop