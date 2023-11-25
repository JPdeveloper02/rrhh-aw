@extends('adminlte::page')

@section('title', 'Dias tareados')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')

    <h2><b>DÍAS TAREADOS</b></h2>
@stop

@section('content')

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#estacion" role="tab" aria-controls="nav-home" aria-selected="true">Por estación</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#todos" role="tab" aria-controls="nav-profile" aria-selected="false">Todos los trabajadores</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#trabajador" role="tab" aria-controls="nav-profile" aria-selected="false">Por trabajador</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    {{-- POR ESTACION --}}
    <div class="tab-pane fade show active" id="estacion" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card">
            <div class="card-header bg-primary">
                Dias tareados por estación
            </div>
            <div class="card-body">
                <form action="{{route('buscar.diastareados')}}" method="POST">
                    @csrf
                <input type="number" name="opcion" value="1" hidden>
                <div class="form-group">
                    <label for="">Seleccione periodo: <span class="text-danger">*</span></label>
                    <select class="form-control" required name="periodo" id="">
                        <option hidden >Seleccione</option>
                        @foreach ($periodos as $item)
                            <option value="{{$item->idPeriodo}}">{{$item->NombrePeriodo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Seleccione estación: <span class="text-danger">*</span></label>
                    <select class="form-control" required name="estacion" id="">
                        <option hidden >Seleccione</option>
                        @foreach ($estaciones as $item)
                            <option value="{{$item->idEstacionDeTrabajo}}">{{$item->NombreEstacionDeTrabajo}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
   {{-- TODOS LOS TRABAJADORES --}}
    <div class="tab-pane fade" id="todos" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="card">
            <div class="card-header bg-primary">
                Listado de todos los tareos por periodo
            </div>
            <div class="card-body">
                <form action="{{route('buscar.diastareados')}}" method="POST">
                    @csrf
                <input type="number" name="opcion" value="2" hidden>
                <div class="form-group">
                    <label for="">Seleccione periodo: <span class="text-danger">*</span></label>
                    <select class="form-control" required name="periodo" id="">
                        <option hidden >Seleccione</option>
                        @foreach ($periodos as $item)
                            <option value="{{$item->idPeriodo}}">{{$item->NombrePeriodo}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>

    {{-- POR TRABAJADOR --}}
    <div class="tab-pane fade" id="trabajador" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="card">
            <div class="card-header bg-primary">
                Dias tareados por estación
            </div>
            <div class="card-body">
                <form action="{{route('buscar.diastareados')}}" method="POST">
                    @csrf
                <input type="number" name="opcion" value="3" hidden>
                <div class="form-group">
                    <label for="">Seleccione periodo: <span class="text-danger">*</span></label>
                    <select class="form-control" required name="periodo" id="">
                        <option hidden >Seleccione</option>
                        @foreach ($periodos as $item)
                            <option value="{{$item->idPeriodo}}">{{$item->NombrePeriodo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Seleccione Trabajador: <span class="text-danger">*</span></label>
                    <select class="form-control select_personal" name="contrato">
                        <option hidden value=""></option>
                        @foreach ($empleados as $item)
                        <option value="{{$item->idContrato}}">{{ strtoupper($item->Nombres.' '.$item->ApellidoPaterno.' '.$item->ApellidoMaterno) }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
  </div>





@stop

@section('js')
    <script src="{{asset('js/tareos/registro.js')}}"></script>
    <script src="{{asset('js/tareos/tareo.js')}}"></script>
@stop