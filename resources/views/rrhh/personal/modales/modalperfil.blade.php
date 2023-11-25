<div class="modal fade" id="modalPerfilContrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-light" id="myModalLabel">Subir documento de contrato</h5>
        </div>
        <!-- ... -->
      <div class="modal-body">
        <form id="pefilContrato" enctype="multipart/form-data">
          <input hidden id="idContratoPerfil" name="id_contrato">
          <div class="form-group">
            <label for="">Documento: <span class="text-danger">*</span></label>
            <input required class="form-control" type="file" name="documento">
          </div>
          <div class="modal-footer">
            <button id="btnPerfilContrato" type="submit" class="btn btn-success btnPerfilContrato">Guardar</button>    
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>