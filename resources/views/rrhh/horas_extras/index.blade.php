@extends('adminlte::page')

@section('title', 'Tareos')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <h2><b>HORAS EXTRAS</b></h2>
@stop

@section('content')
            @if(session('error'))
            <script>
                // Espera a que el DOM esté cargado antes de mostrar la alerta
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ session('error') }}',
                    });
                });
            </script>
            @endif
            @if(session('success'))
            <script>
            // Espera a que el DOM esté cargado antes de mostrar la alerta
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                });
            });
            </script>
            @endif
        <div class="card px-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#reporte" type="button" role="tab" aria-controls="home" aria-selected="true">Reporte de horas extras</button>
                </li>
                <li class="nav-item ml-1" role="presentation">
                  <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#registro" type="button" role="tab" aria-controls="profile" aria-selected="false">Registro de horas extras</button>
                </li>
            </ul>
    
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active my-4" id="reporte" role="tabpanel" aria-labelledby="home-tab">
                    @include('rrhh.horas_extras.complementos.reporte')
                </div>
                <div class="tab-pane fade my-4" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                    @include('rrhh.horas_extras.complementos.registro')
                </div>
            </div>
        </div>
@include('rrhh.tareos.modales.horas_extras')
@stop

@section('js')
    <script src="{{asset('js/horas_extras/reporte.js')}}"></script>
    
    <script>
          const csrfToken = '{{ csrf_token() }}';

          $(document).ready(function () {
            $('.select_personal').select2({
            width: '100%',
            theme: "classic",
            placeholder: "Seleccione Persona",
            allowClear: true
            });
        });
    </script>
@stop