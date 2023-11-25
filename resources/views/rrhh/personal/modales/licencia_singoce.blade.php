<div class="modal fade" id="licencia_singoce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-light" id="myModalLabel">Licencia sin Goce</h5>
        </div>
        <!-- ... -->
      <div class="modal-body">
        <form id="licenciaSinGoce" enctype="multipart/form-data">
          <input hidden id="idContratoInput3" name="id_contrato">
          <div class="form-group">
            <label for="nombre">Estación de trabajo: <span class="text-danger">*</span></label>
            <select name="estacionTrabajo" class="form-control">
              <option value="" hidden>Seleccione estacion de Trabajo</option>
              @foreach ($estaciones as $item)
                  <option value="{{ $item->idEstacionDeTrabajo }}">{{ $item->NombreEstacionDeTrabajo }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="nombre">Fecha de Inicio<span class="text-danger">*</span></label>
            <input required type="date" name="fecha_inicio" class="form-control">
          </div>
          <div class="form-group" id="fecha_fin">
            <label for="nombre">Fecha Fin: <span class="text-danger">*</span></label>
            <input required type="date" name="fecha_fin" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Documento: <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="documento_sin_goce">
          </div>
          <div class="modal-footer">
            <button id="btnLicenciaSinGoce" type="submit" class="btn btn-success">Guardar</button>    
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>