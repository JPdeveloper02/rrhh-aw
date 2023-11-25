<!-- Modal editarCargoModal -->
<div class="modal fade" id="nuevoCargoModal" tabindex="-1" role="dialog" aria-labelledby="editarCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCargoModalLabel">Nuevo Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-nuevo-cargo" action="{{ route('nuevo.cargo') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombreCargo">Nombre de Cargo:</label>
                        <input type="text" name="nombreCargo" class="form-control" id="nombreCargo">
                    </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
            </div>
        </div>
    </div>
</div>