<div class="modal fade" id="horas_extras" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light font-weight-bold"></h5>
        </div>
      <div class="modal-body">
        <form id="form-contrato" action="{{ route('tareo.horaextra') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input hidden type="number" id="idContratoHE" name="idContrato">
          <div class="form-group">
            <label for="">Fecha: <span class="text-danger">*</span></label>
            <input required type="date" class="form-control" name="fecha">
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="inputCampo1">Cantidad de horas extras: <span class="text-danger">*</span></label>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-clock"></i></span>
                                    <input required type="time" class="form-control" id="hora" name="hora_extra">
                                    <small></small>
                                </div>
                                
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