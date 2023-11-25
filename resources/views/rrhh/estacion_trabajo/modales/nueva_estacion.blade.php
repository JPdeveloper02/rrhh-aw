<!-- Modal editarCargoModal -->
<div class="modal fade" id="nuevaEstacionModal" tabindex="-1" role="dialog" aria-labelledby="editarCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCargoModalLabel">Nueva estación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert bg-warning">
                    <i class="fas fa-info-circle"></i> <b>Recordar que de acuerdo al regimen es como se contará las horas en planilla</b>
                </div>
                <form id="form-nueva-estacion" action="{{ route('nueva.estacion') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombreCargo">Nombre de estación:</label>
                        <input type="text" name="nombreEstacion" class="form-control" id="nombreCargo">
                    </div>
                    <div class="form-group">
                        <label for="nombreCargo">Seleccione regimen para estación:</label>
                        <select class="form-control" name="regimen" id="">
                            @foreach ($regimen as $item)
                                <option hidden value="">Seleccione</option>
                                <option value="{{ $item->idRegimenLaboral }}">{{ $item->tipo }}</option>
                            @endforeach
                        </select>
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