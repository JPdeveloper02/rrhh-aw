<div class="modal fade" id="otros_documentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-light" id="myModalLabel"><p id="title"></p></h5>
        </div>
      <div class="modal-body">
        <form id="form_otros" enctype="multipart/form-data">
          <input hidden id="idContratoInput4" name="id_contrato">
          <input hidden type="number" id="tipo_documento" name="tipo_documento">
          <div class="form-group">
            <label for="nombre">Fecha de Registro<span class="text-danger">*</span></label>
            <input required type="date" name="fecha_registro" class="form-control">
          </div>
          <div class="form-group" style="display: none;" id="comentario">
            <label for="">Comentario: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="comentario">
          </div>
          <div class="form-group">
            <label for="">Documento: <span class="text-danger">*</span></label>
            <input class="form-control" type="file" name="documento">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button id="btnOtrosDocumentos" type="submit" class="btn btn-success">Guardar</button>    
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>