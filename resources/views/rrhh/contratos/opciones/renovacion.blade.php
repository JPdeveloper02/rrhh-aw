<div class="card">
  <div class="card-header bg-info text-light">
      <div class="d-flex justify-content-between align-items-center">
          <div>
              <b>Renovación de contrato para trabajador</b>
          </div>
          <div>
              <a href="{{ url('/descargar/contrato/'.$persona->idContrato) }}" class="btn btn-secondary">Plantilla actual de contrato <i class="fas fa-file-signature"></i></a>
          </div>
      </div>
  </div>
    <div class="card-body">
        <form id="form_renovacion" action="{{ route('renovacion.contrato') }}" method="POST">
            @csrf
            <input hidden type="number" value="{{$persona->idContrato}}" name="idContrato">
            <input hidden type="number" class="motivo_cese" name="motivo">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Fecha de Inicio de Contrato:</label>
                <input required class="form-control" type="date" value="{{ date('Y-m-d', strtotime($persona->FechaDeInicioDeContrato)) }}" name="fecha_inicio">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Fecha de Fin de Contrato: <span class="text-danger">*</span></label>
                <input required class="form-control" type="date" name="fecha_fin">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Sueldo: <span class="text-danger">*</span> </label>
                <input required class="form-control" type="number" value="{{$persona->SueldoBase}}" name="sueldo">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">N° de Hijos: <span class="text-danger">*</span> </label>
                <input required class="form-control" type="number" value="{{$persona->NHijos}}" name="num_hijos">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Cargo: <span class="text-danger">*</span> </label>
                <select required class="form-control" name="cargo" id="">
                    <option value="">Seleccione cargo</option>
                    @foreach ($cargos as $cargo)
                        @if($persona->idCargo == $cargo->idCargo)
                            <option value="{{$cargo->idCargo}}" selected>{{$cargo->NombreCargo}}</option>
                        @else
                            <option value="{{$cargo->idCargo}}">{{$cargo->NombreCargo}}</option>
                        @endif
                    @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-info" type="submit">Renovar Contrato</button>
            </div>
          </div>
        </form>
      </div>
</div>