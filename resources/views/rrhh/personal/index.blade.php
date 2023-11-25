@extends('adminlte::page')

@section('title', 'Listado Personal')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h2><b>LISTADO DE PERSONAL ACTIVO</b></h2>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-success">Personal Inactivo <i class="fas fa-eye"></i></button>
        </div>
    </div>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-success">

            </div>
            <div class="card-body">
                {{-- PERSONAL--}}
                        <table id="tabla-Empleados" class="table table-striped table-hover">
                            <thead>
                                <tr class="bg-success">
                                    <th>#</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Cargo</th>
                                    <th>Estacion de Trabajo</th>
                                    <th>Acciones</th>
                                    <th>Doc. Contrato</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($empleados as $item)
                                        <tr>
                                            <td></td>
                                            <td><a href="{{url('personal/perfil/'.$item->idContrato)}}">{{ strtoupper($item->ApellidoPaterno.' '.$item->ApellidoMaterno.' '.$item->Nombres) }}</a></td>
                                            <td>{{ strtoupper($item->NombreCargo) }}</td>
                                            <td>{{ $item->NombreEstacionDeTrabajo.' '.$item->empresa }}</td>
                                            <td>
                                                <select class="form-control select-accion" id="selectAction" onchange="openModal(this)" data-id-contrato="{{ $item->idContrato }}">
                                                    <option hidden value="">Elegir Opción</option>
                                                    <option data-modal-target="#descanso_medico" value="opcion1">DESCANSO MÉDICO</option>
                                                    <option data-modal-target="#licencia_goce" value="opcion2">LICENCIA CON GOCE</option>
                                                    <option data-modal-target="#licencia_singoce" value="opcion3">LICENCIA SIN GOCE</option>
                                                    @foreach ($tipo_documentos as $tipo)
                                                        <option data-modal-target="#otros_documentos" value="{{ $tipo->id_tipodocumento }}">{{ $tipo->tipo }}</option>
                                                    @endforeach
                                                    <option value="contrato">ACCIONES CONTRATO</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->contratopdf)
                                                <a class="btn btn-primary btn-sm" href="{{ asset('storage').'/'.$item->contratopdf }}" target="_blank">Ver documento</a>   
                                                @else
                                                <button class="btn btn-success btn-sm btn-subir-contrato" data-toggle="modal" data-target="#subirContrato" data-empleado="{{ $item->idEmpleado }}">Subir</button>
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>

    @include('rrhh.personal.modales.descanso_medico')
    @include('rrhh.personal.modales.licencia_goce')
    @include('rrhh.personal.modales.licencia_singoce')
    @include('rrhh.personal.modales.otros_documentos')
    @include('rrhh.personal.modales.subirContrato')
@stop

@section('js')
    <script src="{{asset('js/personal/modales.js')}}"></script>
    <script>
        //Rutas para ajax
        const verPersonaUrl = '{{ route("verPersona") }}';
        const guardarContrato = "{{ route('guardarDocContra') }}";
        const descansoMedico = "{{ route('descanso.medico') }}";
        const licenciaConGoce ="{{ route('licencia.Goce') }}";
        const licenciaSinGoce = "{{ route('licencia.Sin.goce') }}";
        const otrosDocumentos = "{{ route('otros.documentos') }}";

        //TOKEN CSRF
        const csrfToken = "{{ csrf_token() }}";
    </script>
@stop