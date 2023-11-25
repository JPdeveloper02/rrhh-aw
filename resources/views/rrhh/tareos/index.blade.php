@extends('adminlte::page')

@section('title', 'Tareos')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <h1>Registro de tareo</h1>
@stop

@section('content')
        <div class="card px-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#router" type="button" role="tab" aria-controls="home" aria-selected="true">Tareo por router</button>
                </li>
                <li class="nav-item ml-1" role="presentation">
                  <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#individual" type="button" role="tab" aria-controls="profile" aria-selected="false">Tareo individual</button>
                </li>
                {{-- <li class="nav-item ml-1" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#hora_extra" type="button" role="tab" aria-controls="profile" aria-selected="false">Horas extras</button>
                  </li> --}}
            </ul>
    
            <div class="tab-content" id="pills-tabContent">
                {{-- Tareo por Router--}}
                <div class="tab-pane fade show active my-4" id="router" role="tabpanel" aria-labelledby="home-tab">
                    <div class="container">
                        @include('rrhh.tareos.tipo_registro.router')
                    </div>
                </div>
                {{-- Tareo Inidividual --}}
                <div class="tab-pane fade my-4" id="individual" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container">
                        @include('rrhh.tareos.tipo_registro.individual')
                    </div>
                </div>
               {{--  <div class="tab-pane fade my-4" id="hora_extra" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container">
                        @include('rrhh.tareos.tipo_registro.horaextra')
                    </div>  
                </div> --}}
            </div>
        </div> 

@include('rrhh.tareos.modales.tareo_individual')
@include('rrhh.tareos.modales.horas_extras')
@stop  

@section('js')
    <script src="{{asset('js/tareos/registro.js')}}"></script>
    <script src="{{asset('js/tareos/tareo.js')}}"></script>
    <script src="{{asset('js/tareos/tareo_router.js')}}"></script>
    <script>
        const tareo_router = "{{route('tareo.router')}}"
    </script>
@stop