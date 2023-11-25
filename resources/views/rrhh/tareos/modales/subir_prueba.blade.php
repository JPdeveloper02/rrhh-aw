<div class="modal fade" id="subir_prueba" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-light font-weight-bold"><b>Registro de pruebas tareo - <b>{{ $estacion->NombreEstacionDeTrabajo }}</b></b></h5>
            </div>
            <div class="modal-body">
                <form id="form_pruebatareo" action="{{ route('registrar.prueba') }}" enctype="multipart/form-data">
                    @csrf
                    <input hidden type="number" id="idEstacion" name="idEstacion" value="{{ $estacion->idEstacionDeTrabajo }}">
                    <div class="form-group">
                        <label for="">Fecha a registrar:</label>
                        <input readonly class="form-control" type="date" id="fecha_input" name="fecha">
                    </div>
                    <div class="form-group">
                        <label for="">Registre imagen o documento: <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="documento">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>