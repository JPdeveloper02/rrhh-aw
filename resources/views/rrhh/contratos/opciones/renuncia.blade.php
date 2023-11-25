<div class="card">
    <div class="card-header bg-info text-light">
        <b>Cese de contrato para trabajador</b>
    </div>
    <div class="card-body">
        <form action="{{ route('cese.contrato') }}" method="POST">
            @csrf
            <input hidden type="number" value="{{$persona->idContrato}}" name="idContrato">
            <input hidden type="number" name="motivo" class="motivo_cese">
          <div class="form-group">
            <label for="">Fecha de Cese: <span class="text-danger">*</span></label>
            <input required class="form-control" type="date" name="fecha_cese" id="">
          </div>
          <div class="form-group">
            <label for="">Motivo: <span class="text-danger">*</span></label>
            <textarea required class="form-control" id="" cols="30" rows="2" name="descripcion_cese" placeholder="Descripcion de motivo de cese"></textarea>
          </div>
          <button class="btn btn-info" type="submit">Registrar Cese</button>
        </form>
      </div>
</div>