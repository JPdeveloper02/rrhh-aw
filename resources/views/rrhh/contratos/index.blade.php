@extends('adminlte::page')

@section('title', 'Contrato de Personas')
@section('plugins.Datatables', true)
@section('plugins.jquery', true)
@section('plugins.Sweetalert2', true)
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('content_header')
<h4>Actualización de contrato para <b>{{ strtoupper($persona->Nombres.' '.$persona->ApellidoPaterno.' '.$persona->ApellidoMaterno) }}</b></h4>
@stop

@section('content')
@include('rrhh.contratos.alerts.alerts')
<div class="card">
   <div class="card-header bg-success">
    <h6><b>Seleccione opción a modificar</b></h6>
   </div>
   <div class="card-body">
    <div class="col">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <select class="form-control" name="" id="select_contrato">
                <option hidden value="">Seleccione opción a ejecutar</option>
               @foreach ($motivos as $item)
                   <option value="{{ $item->idMotivosDeCese }}">{{ $item->NombreMotivosDeCese }}</option>
               @endforeach
            </select>
          </div>
        </div>
      </div>
   </div>
</div>
{{-- Vista de acuerdo a opcion seleccionada --}}
<div class="card mb-2">
    <div class="card-header">
    </div>
    <div class="card-body" style="display: none;" id="renovacion">
        @include('rrhh.contratos.opciones.renovacion')
    </div>
    <div class="card-body" style="display: none;" id="renuncia">
        @include('rrhh.contratos.opciones.renuncia')
    </div>
    <div class="card-body" style="display: none;" id="fin_contrato">
        @include('rrhh.contratos.opciones.fin_contrato')
    </div>
 </div>

@stop

@section('js')
<script src="{{ asset('js/contratos/opciones.js') }}"></script>
@stop