@extends('adminlte::page')

@section('title', 'Listado Personal')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h2><b>REGISTRO DE NUEVO TRABAJADOR</b></h2>
        </div>
    </div>
@stop

@section('content')
 
    <div class="row justify-content-center">
      <div class="col-md-11">
        <div class="card">
          <div class="card-header bg-success text-light">
            <h3 class="card-title">Contratación de Nuevo Empleado</h3>
          </div>   
          <div class="card-body">
            <form id="form_nuevo_contrato" action="{{ route('registrar.contrato') }}" enctype="multipart/form-data">
              @csrf
            <div class="container custom-container">
              <div class="card mb-3">
                <div class="card-header bg-success text-light">
                  <h5 class="card-title">Datos Personales</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="nombres" value="" class="form-control" placeholder="Nombres">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="ap_paterno" class="form-control" placeholder="Apellido Paterno">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input name="ap_materno" type="text" class="form-control" placeholder="Apellido Materno">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input required name="email" type="email" class="form-control" placeholder="Email">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input required type="number" name="dni" class="form-control" placeholder="DNI">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                            <input required name="celular" type="number" class="form-control" placeholder="Celular">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <input required name="direccion" type="text" class="form-control" placeholder="Direccion">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                            <input required type="text" placeholder="Fecha De Nacimiento" onfocus="(this.type='date')" class="form-control" name="fecha_nacimiento">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input required name="nombre_contacto" type="text" class="form-control" placeholder="Nombre Contacto de Emergencia">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input required type="number" class="form-control" name="numero_contacto" placeholder="Numero contacto de emergencia">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-syringe"></i></span>
                           <select required class="form-control" name="tipo_sangre" id="">
                            <option hidden value="">Tipo de Sangre</option>
                            @foreach ($sangre as $s)
                                <option value="{{ $s->idTipoDeSangre }}">{{ $s->NombreTipoDeSangre }}</option>
                            @endforeach
                           </select>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              
              <div class="card mb-3">
                <div class="card-header bg-success text-light">
                  <h5 class="card-title">Datos Profesionales</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            <input required type="text" class="form-control" name="profesion" placeholder="Profesion">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-car"></i></span>
                            <select class="form-control" name="select_tipo_licencia" id="select_tipo_licencia">
                              <option hidden value="">Tipo Licencia</option>
                              <option value="NO">Ninguna</option>
                              <option value="A-I">A-I</option>
                              <option value="A-IIa">A-IIa</option>
                              <option value="A-IIb">A-IIb</option>
                              <option value="A-IIIa">A-IIIa</option>
                              <option value="A-IIIb">A-IIIb</option>
                              <option value="A-IV">A-IV</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                           <select required class="form-control" name="cargo" id="">
                            <option hidden value="">Cargo</option>
                            @foreach ($cargos as $cargo)
                            <option value="{{ $cargo->idCargo }}">{{ strtoupper($cargo->NombreCargo) }}</option>
                            @endforeach                            
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                           <select required class="form-control" name="fondo" id="">
                            <option hidden value="">Fondo de Pension</option>
                            @foreach ($fondo_pension as $fondo)
                                <option value="{{ $fondo->idFondoDePension }}">{{ $fondo->NombreEntidad }}</option>
                            @endforeach
                           </select>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header bg-success text-light">
                  <h5 class="card-title">Datos para Empresa</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                            <input required type="text" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio Contrato" onfocus="(this.type='date')">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                            <input required type="text" name="fecha_fin" class="form-control" placeholder="Fecha FIN Contrato" onfocus="(this.type='date')">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                            <input required type="number" name="sueldo_base" class="form-control" placeholder="Sueldo Base">
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-baby"></i></span>
                            <input required type="number" name="num_hijos" class="form-control" placeholder="Numero de Hijos">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                           <select required class="form-control" name="estacion" id="">
                            <option hidden value="">Estación de Trabajo</option>
                            @foreach ($estaciones as $estacion)
                                <option value="{{ $estacion->idEstacionDeTrabajo}}">{{ $estacion->NombreEstacionDeTrabajo }}</option>
                            @endforeach
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-hospital"></i></span>
                            <input class="form-control" type="text" name="alergias" placeholder="Alergias">
                          </div>
                          <small>Si no tiene alergías, dejar vacío.</small>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                            <input class="form-control" type="number" name="pension" placeholder="Porcentaje Pensión alimenticia">
                          </div>
                          <small>Si no realiza pago, dejar vacío.</small>
                        </div>
                      </div>
                    </div>
                    
                </div>
              </div>
              <div class="ml-auto mb-2 text-end">
                <button type="submit" class="btn btn-success btn-block mt-3">Registrar Candidato</button>
              </div>
            </div>
        </form>
          </div>
        </div>
      </div>
    </div>
   
    @if (Session::has('success'))
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

    @if (Session::has('error'))
    <script>
        // Espera a que el DOM esté cargado antes de mostrar la alerta
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                html: '{!! session('exception') ?? '' !!}',
            });
        });
    </script>
@endif

@stop

@section('js')
<script src="{{ asset('js/personal/nuevo_contrato.js') }}"></script>
@stop