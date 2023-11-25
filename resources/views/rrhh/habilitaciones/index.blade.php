@extends('adminlte::page')

@section('title', 'Habilitacion Personal')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h2><b>HABILITACIONES TRABAJADOR</b></h2>
        </div>
    </div>
@stop

@section('content')
@include('rrhh.habilitaciones.alerts.alerts')
        <div class="card">
            <div class="card-header bg-success">
                <div class="d-flex justify-content-end">
                  <button class="btn btn-light mr-2" type="button" data-toggle="modal" data-target="#nuevo_curso">Registrar cursos  <i class="fas fa-plus-square"></i></button>
                  <button class="btn btn-light mr-2" type="button" data-toggle="modal" data-target="#listado_curso">Listado cursos  <i class="fas fa-list-alt"></i></button>
                </div>
              </div>
            <div class="card-body">
                <form action="{{ route('habilitaciones.buscar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Seleccione Persona: <span class="text-danger">*</span></label>
                      <select class="form-control select_personal" name="id_empleado"  onchange="this.form.submit()"" data-modal-target="#tareo_individual" data-id-contrato="">
                          <option hidden value=""></option>
                          @foreach ($empleados as $item)
                          <option value="{{$item->idEmpleado}}">{{ strtoupper($item->Nombres.' '.$item->ApellidoPaterno.' '.$item->ApellidoMaterno) }}</option>
                          @endforeach
                      </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            @if (isset($empleado) && $empleado !== null)
            <div class="card-body">
                @include('rrhh.habilitaciones.complementos.panel')
            </div>
            @else
            <div class="card-body">
                No se encontraron resultados
            </div>    
            @endif
        </div>

@include('rrhh.habilitaciones.modales.cursos')
@include('rrhh.habilitaciones.modales.listado_cursos')
@stop

@section('js')
    <script src="{{asset('js/personal/modales.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select_personal').select2({
            width: '100%',
            theme: "classic",
            placeholder: "Seleccione Persona",
            allowClear: true
            });
            $('.select_cursos').select2({
            width: '100%',
            theme: "classic",
            dropdownParent: $('#nuevo_curso .modal-body'),
            placeholder: "Seleccione",
            allowClear: true
            });
        });

    </script>
    
@stop