<!-- Modal -->
<div class="modal fade" id="modalPreboleta" tabindex="-1" role="dialog" aria-labelledby="modalPreboletaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPreboletaLabel">Vista del PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPreboleta" action="{{ route('enviar.preboleta') }}" method="POST">
                @csrf
                <input hidden type="number" name="idPeriodo" id="idPeriodo">
                <input hidden type="text" id="url" name="url">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <input required readonly type="text" class="form-control" name="destinatario" id="email" aria-describedby="emailAddon">
                        <div class="input-group-append">
                            <span class="input-group-text" id="emailAddon"><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea required class="form-control" name="mensaje" cols="30" rows="2" id="mensaje"></textarea>
                </div>
                <!-- Contenido del PDF -->
                <iframe id="pdfIframe" style="width: 100%; height: 550px;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Enviar Email <i class="fas fa-paper-plane"></i></button>
            </form>
            </div>
        </div>
    </div>
</div>