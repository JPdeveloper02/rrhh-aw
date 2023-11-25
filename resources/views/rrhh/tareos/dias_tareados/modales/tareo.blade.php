<div class="modal fade" id="tareoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header bg-primary">
              <h5 class="modal-title" id="titleModal"><b>TAREO</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="formTareo">
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <input type="text" name="contrato" class="form-control" placeholder="Contrato">
                      </div>
                      <div class="form-group col-md-6">
                          <input type="text" name="tareo" id="tareo" class="form-control" placeholder="Tareo">
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="estacion">
                              <i class="fas fa-building"></i> Estación de Trabajo:
                          </label>
                          <select name="estacion" class="form-control">
                              <option value="" hidden>Seleccione Estación</option>
                              @foreach ($estaciones as $item)
                                  <option value="{{ $item->idEstacionDeTrabajo }}">{{ $item->NombreEstacionDeTrabajo }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="condicionTareo">
                              <i class="fas fa-check-circle"></i> Condición del Tareo:
                          </label>
                          <select name="condicionTareo" class="form-control">
                              <option value="" hidden>Seleccione Condición</option>
                              @foreach ($condicionTareo as $item)
                                  <option value="{{ $item->idCondicionDeTareo }}">{{ $item->NombreCondicionDeTareo }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="fecha">
                              <i class="far fa-calendar-alt"></i> Fecha:
                          </label>
                          <input type="date" class="form-control" name="fecha">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="horaIngreso">
                              <i class="far fa-clock"></i> Ingreso:
                          </label>
                          <input type="time" class="form-control" name="horaIngreso">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inicioAlmuerzo">
                          <i class="fas fa-utensils"></i> Almuerzo:
                      </label>
                      <div class="row">
                          <div class="col-md-6">
                              <input type="time" class="form-control" name="inicioAlmuerzo">
                          </div>
                          <div class="col-md-6">
                              <input type="time" class="form-control" name="finAlmuerzo">
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="horaSalida">
                          <i class="far fa-clock"></i> Salida:
                      </label>
                      <input type="time" class="form-control" name="horaSalida">
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <div class="d-flex justify-content-between">
                <button type="button" id="btnGuardarTareo" class="btn btn-primary m-2">Guardar Cambios <i class="fas fa-save"></i></button>
                <button type="button" id="btnEliminarTareo" class="btn btn-danger m-2">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </div>
        </div>
      </div>
  </div>
</div>