@extends('adminlte::page')

@section('title', 'Perfil de Trabajador')
@section('plugins.Datatables', true)
@section('plugins.jquery', true)
@section('plugins.Sweetalert2', true)
@section('css')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

@stop
@section('content_header')
<div class="row">
  <div class="col-md-6">
      <h2><b>PERFIL DE EMPLEADO</b></h2>
  </div>
  <div class="col-md-6 text-right">
      <button class="btn btn-danger">Dar de baja <span></span> <i class="fas fa-user-times"></i></button>
  </div>
</div>
@stop

@section('content')
{{-- Cover y foto --}}
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="cover-photo"></div>
                <div class="profile-container">
                    <div class="profile-picture">
                      <img id="profile-image" src="https://cdn.pixabay.com/photo/2019/08/11/18/59/icon-4399701_1280.png" alt="Foto de perfil">
                    </div>
                    <div class="profile-details">
                        <h1 class="profile-name">{{ strtoupper($persona->Nombres." ".$persona->ApellidoPaterno." ".$persona->ApellidoMaterno) }}</h1>
                        <p class="profile-cargo">{{ strtoupper($persona->NombreCargo) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="row container-box">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ date('d/m/Y',strtotime($persona->FechaDeNacimiento)) }}</h3>
                <p>Fecha de Cumpleaños</p>
            </div>
            <div class="icon">
              <i class="fas fa-birthday-cake text-light"></i>
            </div>
            <a href="#" class="small-box-footer">Enviar Mensaje <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $num_contratos }}</h3>

                <p>Contrato(s) realizados</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-signature text-light"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
              @php
              $fechaNacimiento = $persona->FechaDeNacimiento;
              $edad = date_diff(date_create($fechaNacimiento), date_create('today'))->y;
              @endphp
                <h3 class="text-light">{{ $edad }}</h3>

                <p class="text-light">Años</p>
            </div>
            <div class="icon">
              <i class="far fa-user-circle text-light"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 class="text-light">{{ $dias_trabajados }}</h3>

                <p class="text-light">Días trabajados</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-tie text-light"></i>
            </div>
            <a href="#" class="small-box-footer text-light">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

  
{{-- Mostrado de Datos --}}
  <ul class="nav nav-tabs container-buttons" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="home" aria-selected="true">Datos Personales</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profesional" role="tab" aria-controls="profile" aria-selected="false">Datos Profesionales</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#documentos" role="tab" aria-controls="contact" aria-selected="false">Documentos</a>
    </li>
  </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="home-tab">
        @include('rrhh.personal.profile.complementos.datos_personales')
      </div>
      <div class="tab-pane fade" id="profesional" role="tabpanel" aria-labelledby="profile-tab">
        @include('rrhh.personal.profile.complementos.datos_profesionales')
      </div>
      <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="contact-tab">
        @include('rrhh.personal.profile.complementos.documentos')
      </div>
    </div>
  @include('rrhh.personal.profile.modales.datos_personales')
  @include('rrhh.personal.profile.modales.datos_profesionales')
  @include('rrhh.personal.modales.subirContrato')
  @include('rrhh.personal.modales.modalperfil')
  @include('rrhh.personal.modales.editarFechaContrato')
@stop

@section('js')
<script src="{{ asset('js/contratos/opciones.js') }}"></script>
<script src="{{ asset('js/personal/editar_datos.js') }}"></script>
<script src="{{ asset('js/personal/modales.js') }}"></script>
<script>
   const csrfToken = "{{ csrf_token() }}";
</script>

@stop