<div class="modal fade" id="descanso_medico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light" id="myModalLabel">Descanso Médico</h5>
        </div>
        <!-- ... -->
      <div class="modal-body">
        <form id="descansoMedico" enctype="multipart/form-data">
          <input hidden id="idContratoInput1" name="id_contrato">
          <div class="form-group">
            <label for="nombre">Estación de trabajo: <span class="text-danger">*</span></label>
            <select name="estacionesTrabajo" class="form-control">
              <option value="" hidden>Seleccione una Estacion de Trabajo</option>
              @foreach ($estaciones as $item)
                  <option value="{{ $item->idEstacionDeTrabajo }}">{{ $item->NombreEstacionDeTrabajo }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="nombre">Fecha de Inicio<span class="text-danger">*</span></label>
            <input required type="date" name="feDescMedico" class="form-control">
          </div>
          <div class="form-group" id="fecha_fin">
            <label for="nombre">Fecha Fin: <span class="text-danger">*</span></label>
            <input required type="date" name="feFinDescMedico" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Documento: <span class="text-danger">*</span></label>
            <input class="form-control-file" type="file" name="documento_descanso" id="documento_descanso">
          </div>
          <div class="modal-footer">
            <button id="btnGuardarDescansoMedico" type="submit" class="btn btn-success">Guardar</button>    
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>