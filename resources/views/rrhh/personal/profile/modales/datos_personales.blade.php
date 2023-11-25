<!-- Modal -->
<div class="modal fade" id="modalEditarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b>Editar datos de trabajor</b> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form id="form_editar_datos_personales" action="{{ route('datos.personales') }}" method="POST">
          @csrf
              <input hidden type="number" name="idPersona" value="{{ $persona->idPersona }}">
              <input hidden type="number" name="idContrato" value="{{ $persona->idContrato }}">
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-user text-primary"></i>
                        <label for="dni" class="badge badge-primary">Nombre completo:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="Nombres" id="nombre" value="{{ strtoupper($persona->Nombres) }}"  >
                      </div>
                    </div>
                    <div class="form-group row div-nombrecompleto">
                      <div class="col-sm-4">
                        <i class="fas fa-user text-primary"></i>
                        <label for="dni" class="badge badge-primary">Apellido paterno:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="ApellidoPaterno" id="apellidoPaterno" value="{{ strtoupper($persona->ApellidoPaterno) }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-user text-primary"></i>
                        <label for="dni" class="badge badge-primary">DNI:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="DNI" id="dni" value="{{ $persona->DNI }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-phone-alt text-primary"></i>
                        <label for="numeroCelular" class="badge badge-primary">Número de celular:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="telefono" id="numeroCelular" value="{{ $persona->Telefono }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-home text-primary"></i>
                        <label for="direccion" class="badge badge-primary">Dirección:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $persona->direccion }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-birthday-cake text-primary"></i>
                        <label for="fechaNacimiento" class="badge badge-primary">Fecha de Nacimiento:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="date" class="form-control" name="FechaDeNacimiento" id="fechaNacimiento" value="{{ date('d/m/Y',strtotime($persona->FechaDeNacimiento)) }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-envelope text-primary"></i>
                        <label for="email" class="badge badge-primary">Email:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="Email" id="email" value="{{ $persona->Email }}"  >
                      </div>
                    </div>
                  </div>
            
                  <div class="col-md-6">
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-user text-primary"></i>
                        <label for="dni" class="badge badge-primary">Apellido materno:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="ApellidoMaterno" id="apellidoMaterno" value="{{ strtoupper($persona->ApellidoMaterno) }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-crutch text-primary"></i>
                        <label for="tipoSangre" class="badge badge-primary">Tipo de Sangre:</label>
                      </div>
                      <div class="col-sm-6">
                        <select class="form-control" name="tipo_sangre" id="">
                          <option hidden value="">Seleccionar</option>
                          @foreach ($tipos_sangre as $item)
                            <option value="{{ $item->idTipoDeSangre }}" @if ($persona->NombreTipoDeSangre == $item->NombreTipoDeSangre) selected @endif>{{ $item->NombreTipoDeSangre }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
            
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-viruses text-primary"></i>
                        <label for="alergias" class="badge badge-primary">Alergias:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="alergias" id="alergias" value="{{ $persona->Alergias }}"  >
                      </div>
                    </div>
            
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-user text-primary"></i>
                        <label for="contactoEmergencia" class="badge badge-primary">Contacto de Emergencia:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="ContactoDeEmergencia" id="contactoEmergencia" value="{{ $persona->ContactoDeEmergencia }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-phone-alt text-primary"></i>
                        <label for="numeroContacto" class="badge badge-primary">Número de contacto:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="NumeroDeContacto" id="numeroContacto" value="{{ $persona->NumeroDeEmergencia }}"  >
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <i class="fas fa-child text-primary"></i>
                        <label for="numeroHijos" class="badge badge-primary">Numero hijos:</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="text" name="NumeroHijos" class="form-control" id="numeroHijos" value="{{ $persona->NHijos }}"  >
                      </div>
                    </div>
              </div>
              </div>
            </div> 
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar datos</button>
            </form>
          </div>
      </div>
  </div>
</div>