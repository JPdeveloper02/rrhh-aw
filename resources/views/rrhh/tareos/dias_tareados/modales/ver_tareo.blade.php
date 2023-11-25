<div class="modal fade" id="modalTareo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">TAREO</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="iframe-container">
            <iframe id="pdfIframe" style="width: 100%; height: 550px;"></iframe>
          </div>
          <div class="zoom-controls">
            <button id="zoomInButton" class="btn btn-primary" onclick="zoomIn()">Zoom In</button>
            <button id="zoomOutButton" class="btn btn-primary" onclick="zoomOut()">Zoom Out</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>