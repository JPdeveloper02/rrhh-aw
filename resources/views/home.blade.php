@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1><b></b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('complementos.estadisticas')
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary">
        <h4><b>ESTADO DE CONTRATOS</b></h4>
    </div>
    <div class="card-body">
        @include('complementos.contratos')
    </div>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop