<div class="card">
    <div class="card-header bg-info text-light">
        <b>Fin de contrato de trabajador</b>
    </div>
    <div class="card-body">
        <form  action="{{ route('fin.contrato') }}" method="POST">
            @csrf
            <input hidden type="number" name="idContrato" value="{{$persona->idContrato}}">
            <input hidden type="number" name="motivo" class="motivo_cese">
          <div class="form-group">
            <label for="">Motivo de fin de contrato / No renovación: <span class="text-danger">*</span></label>
            <textarea required class="form-control" name="descripcion_cese" id="" cols="30" rows="2" placeholder="Descripcion"></textarea>
          </div>
          <button class="btn btn-info" type="submit">Registrar fin</button>
        </form>
      </div>
</div>