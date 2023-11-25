<div class="modal fade" id="registro_descuentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light font-weight-bold"></h5>
        </div>
      <div class="modal-body">
        <form id="form-registro-descuento" action="{{ route('registro.descuento') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input hidden type="number" id="idContrato" name="idContrato">
          <div class="form-group">
            <label for="">Tipos de descuento: <span class="text-danger">*</span></label>
            <select required class="form-control" name="tipo_descuento" id="select-descuento">
                <option hidden value="">Seleccione</option>
                <option value="1">ADELANTOS</option>    
                <option value="2">PRESTAMOS</option>
                <option value="3">OTROS DESCUENTOS</option>
            </select>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="inputCampo1">Fecha: <span class="text-danger">*</span></label>
                        <div class="col">             
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-calendar-alt"></i></span>
                                    <input required type="date" name="fecha" class="form-control" id="fecha">
                                </div>
                                <small class="form-text text-muted">Se descontará de acuerdo a esta fecha.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="div-monto">
                        <label for="inputCampo3">Monto a descontar: <span class="text-danger">*</span></label>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-comment-dollar"></i></span>
                                    <input type="text" name="monto" class="form-control" pattern="[0-9]+(\.[0-9]{1,2})?" title="Introduce un número decimal válido con hasta 2 decimales">
                                </div>
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="div-cuotas" style="display: none;">
                        <label for="inputCampo3">Cantidad de cuotas: <span class="text-danger">*</span></label>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-comment-dollar"></i></span>
                                    <input type="number" name="cuotas" min="0" class="form-control" id="input_cuotas">
                                </div>
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row" id="div-tabla" style="display: none;">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-12">
                        <small>Los campos fecha y monto son editables</small>
                        <table class="table table-bordered" id="tabla-prestamos">
                            <thead>
                                <tr class="bg-success">
                                    <th class="text-center" colspan="3">CRONOGRAMA DE PRÉSTAMOS</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
          <div class="row" id="div-documento">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="inputCampo1">Documento:</label>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-file-pdf"></i></span>
                                    <input type="file" name="documento" class="form-control">
                                </div>
                                <small class="form-text text-muted">Ingresar solo si es necesario</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row" id="div-motivo">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="inputCampo3">Comentario:</label>
                        <div class="col">
                            <div class="form-group">     
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-people-arrows"></i></span>
                                    <textarea type="text" name="motivo" class="form-control"></textarea>
                                </div>
                                <small class="form-text text-muted">Llenar solo si es necesario</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>    
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>