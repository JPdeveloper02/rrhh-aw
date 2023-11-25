@extends('adminlte::page')

@section('title', 'Dias tareados')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <h2><b>PLANILLA</b></h2>
@stop

@section('content')
<div class="card">
    <div class="card-header bg-primary">
        Dias tareados 
    </div>
    <div class="card-body">
        <form action="{{route('buscar.planilla')}}" method="POST">
            @csrf
        <div class="form-group">
            <label for="">Seleccione periodo:</label>
            <select class="form-control" required name="periodo" id="" onchange="this.form.submit()">
                <option hidden >Seleccione</option>
                @foreach ($periodos as $item)
                    <option value="{{$item->idPeriodo}}">{{$item->NombrePeriodo}}</option>
                @endforeach
            </select>
        </div>
        </form>
    </div>
</div>

@stop

@section('js')

@stop