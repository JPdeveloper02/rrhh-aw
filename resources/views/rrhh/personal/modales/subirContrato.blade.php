<!-- Modal -->
<div class="modal fade" id="subirContrato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-green">
          <h5 class="modal-title" id="exampleModalLabel">Subir el documento del Contrato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Apellidos y Nombres:</label>
                  <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="datoPersonaNombres">
                  </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Cargo:</label>
                  <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="Cargo">
                  </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Fecha Inicio:</label>
                  <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="contratoInicio">
                  </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Fecha Fin:</label>
                  <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="contratoFin">
                  </div>
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Empresa:</label>
                  <div class="col-sm-8">
                    <input type="text" readonly class="form-control-plaintext" id="contratoEmpresa">
                  </div>
              </div>
            </div>
          </div>
          <hr>
            <form id="guardarContratoDoc" enctype="multipart/form-data">
                <input hidden type="text" class="form-control" id="idEmpleadoContra" name="idEmpleadoContra">
                <div class="mb-3">
                    <label for="formFile" class="form-label"><b>Seleccion el contrato en PDF:</b></label>
                    <input class="form-control-file" type="file" id="formFile" name="formFile">
                </div>

                <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
            </form>
        </div>
      </div>
    </div>
</div>