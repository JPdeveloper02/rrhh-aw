<div class="modal fade" id="modalEditarFecha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-light" id="myModalLabel">Editar fechas de contrato</h5>
        </div>
        <!-- ... -->
      <div class="modal-body">
        <form id="pefilEditarFecha" enctype="multipart/form-data">
          <input hidden id="idContratoPerfilFecha" name="id_contrato">
          <div class="form-group">
            <label for="">Fecha de inicio de contrato:<span class="text-danger">*</span></label>
            <input required class="form-control" id="fecha_inicio_fechas" type="date" name="fecha_inicio">
          </div>
          <div class="form-group">
            <label for="">Fecha fin de contrato: <span class="text-danger">*</span></label>
            <input required class="form-control" id="fecha_fin_fechas" type="date" name="fecha_fin">
          </div>
          <div class="modal-footer">
            <button id="btnPerfilEFecha" type="submit" class="btn btn-success btnPerfilEFecha">Guardar</button>    
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>