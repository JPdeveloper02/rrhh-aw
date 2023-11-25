@extends('adminlte::page')

@section('title', 'Pruebas tareo')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h2><b>FOTOS TAREOS</b></h2>
@stop

@section('content')
<div class="card">
    <div class="card-header bg-success">
        Digite y seleccione para buscar
    </div>
    <div class="card-body">
        <form action="{{ route('buscar.fotos.tareos') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="">Fecha Inicio</label>
                    <input required type="date" class="form-control" name="fecha_inicio" value="">
                </div>
                <div class="col-md-4">
                    <label for="">Fecha Fin</label>
                    <input required type="date" class="form-control" name="fecha_fin" value="">
                </div>
                <div class="col-md-4">
                    <label for="">Seleccione estación</label>
                    <select required class="form-control" name="estacion_id" id="">
                        <option hidden value="">Seleccione</option>
                        @foreach ($estaciones as $item)
                            <option value="{{ $item->idEstacionDeTrabajo }}">{{ $item->NombreEstacionDeTrabajo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-2">
                <button class="btn btn-success" type="submit">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    @if(isset($fechas) && count($fechas) > 0)
    @include('rrhh.tareos.modales.subir_prueba')
    <div class="card-header">
        <h4>Estación de trabajo: <b>{{ $estacion->NombreEstacionDeTrabajo }}</b></h4>
    </div>
      <!-- Mostrar la colección de fechas -->
      <div class="card-body">
      <div class="row">
        @foreach ($fechas as $fecha)
        @php
            $fecha_form = date('d/m/Y', strtotime($fecha))
        @endphp
          <div class="col-md-3">
            <div class="card mt-4">
              @php
                $coincidenciaEncontrada = false;
              @endphp
              @foreach ($pruebasTareo as $pruebaTareo)
                @php
                    $fecha_pruebas =  date('d/m/Y', strtotime($pruebaTareo->Fecha_prueba));
                @endphp
                @if ($fecha_pruebas == $fecha_form)
                  @php
                    $coincidenciaEncontrada = true;
                  @endphp
                  <!-- Impresión específica si hay coincidencia en pruebas_tareo -->
                  <div class="card-header bg-success d-flex align-items-center">
                    <span><b>{{ $fecha_form }}</b></span>
                   
                </div>
                  <div class="card-body text-center">
                    @if ($coincidenciaEncontrada)
                    <a href="{{ asset('storage').'/'.$pruebaTareo->img_prueba_tareo }}" target="_blank" class="btn btn-success">
                        Ver <i class="fas fa-eye"></i>
                    </a>
                    @endif
                </div>
                <div class="card-footer d-flex align-items-center">
                    <span><b>Imagen/Archivo registrado</b></span>
                    <button class="btn btn-danger w-2 h-2 ml-auto" onclick="eliminarRegistro('{{ $estacion->idEstacionDeTrabajo }}', '{{ $pruebaTareo->Fecha_prueba }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                  @break
                @endif
              @endforeach
              @if (!$coincidenciaEncontrada)
                <!-- Impresión alternativa si no hay coincidencia en pruebas_tareo -->
                <div class="card-header bg-info">
                    <b>{{ $fecha_form }}</b>
                </div>
                <div class="card-body text-center">
                    <button class="btn btn-info agregar-btn" data-toggle="modal" data-target="#subir_prueba"  data-fecha="{{ $fecha_form }}">
                        Agregar <i class="fas fa-plus-square"></i>
                    </button>
                </div>
                <div class="card-footer">
                    <b>No hay Imagen/archivo registrado</b>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
    @else
      <!-- Mostrar un mensaje si la colección no existe o está vacía -->
      <div class="card-body">
      <div class="alert alert-warning" role="alert">
        No se encontraron resultados
      </div>
    </div>
    @endif
  </div>

@stop

@section('js')
<script src="{{ asset('js/tareos/pruebas_tareo.js') }}"></script>

@stop