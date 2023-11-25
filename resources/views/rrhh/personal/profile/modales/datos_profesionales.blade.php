<!-- Modal -->
<div class="modal fade" id="modalEditarDatosProfesionales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Editar datos de trabajor</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="form_editar_datos_profesionales" action="{{ route('datos.profesionales') }}" method="POST">
            @csrf
                <input hidden type="number" name="idPersona" value="{{ $persona->idPersona }}">
                <input hidden type="number" name="idContrato" value="{{ $persona->idContrato }}">
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <div class="col-sm-4">
                            <i class="fas fa-file-signature text-primary"></i>
                            <label for="nombre" class="badge badge-primary">Fecha Inicio de Contrato:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="fecha_inicio" value="{{ $persona->FechaDeInicioDeContrato }}">
                        </div>
                    </div>
                      <div class="form-group row">
                        <div class="col-sm-4">
                            <i class="fas fa-file-signature text-primary"></i>
                            <label for="nombre" class="badge badge-primary">Fecha fin de Contrato:</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="fecha_fin" value="{{ $persona->FechaDeFinDeContrato }}">
                        </div>
                    </div>
                      <div class="form-group row">
                        <div class="col-sm-4">
                          <i class="fas fa-briefcase text-primary"></i>
                          <label for="nombre" class="badge badge-primary">Cargo:</label>
                        </div>
                        <div class="col-sm-6">
                          <select class="form-control" name="cargo" id="">
                            <option hidden value="">Seleccionar</option>
                            @foreach ($cargos as $item)
                              <option value="{{ $item->idCargo }}" @if ($persona->idCargo == $item->idCargo) selected @endif>{{ $item->NombreCargo }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-4">
                            <i class="fas fa-user-lock text-primary"></i>
                            <label for="nombre" class="badge badge-primary">Fondo de Pensión:</label>
                          </div>
                          <div class="col-sm-6">
                            <select class="form-control" name="fondo_pension" id="">
                              <option hidden value="">Seleccionar</option>
                              @foreach ($fondo_pension as $item)
                                <option value="{{ $item->idFondoDePension }}" @if ($persona->idFondoDePension == $item->idFondoDePension) selected @endif>{{ $item->NombreEntidad }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <div class="col-sm-4">
                          <i class="fas fa-building text-primary"></i>
                          <label for="nombre" class="badge badge-primary">Estación de trabajo:</label>
                        </div>
                        <div class="col-sm-6">
                          <select class="form-control" name="estacion_trabajo" id="">
                            <option hidden value="">Seleccionar</option>
                            @foreach ($estaciones as $item)
                              <option value="{{ $item->idEstacionDeTrabajo }}" @if ($persona->idEstacionDeTrabajo == $item->idEstacionDeTrabajo) selected @endif>{{ $item->NombreEstacionDeTrabajo }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-sm-4">
                          <i class="fas fa-money-check-alt text-primary"></i>
                          <label for="nombre" class="badge badge-primary">Sueldo Base:</label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="sueldo_base" id="nombre" value="{{ $persona->SueldoBase }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-4">
                          <i class="fas fa-baby text-primary"></i>
                          <label for="nombre" class="badge badge-primary">Pension alimenticia:</label>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="pension_alimenticia" id="nombre" value="{{ $persona->pensionAlimenticia }}">
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