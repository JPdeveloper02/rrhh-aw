<div class="modal fade" id="tareo_individual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light font-weight-bold"></h5>
        </div>
      <div class="modal-body">
        <form id="form-contrato" action="{{ route('tareo.individual') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input hidden type="number" id="idContrato" name="idContrato">
          <div class="form-group">
            <label for="">Condición de tareo: <span class="text-danger">*</span></label>
            <select required class="form-control" name="condicion_tareo" id="">
                @foreach ($condiciones as $item)
                <option value="{{$item->idCondicionDeTareo}}">{{$item->NombreCondicionDeTareo}}</option>    
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Estacion: <span class="text-danger">*</span></label>
            <option hidden value="">Seleccione</option>
            <select required class="form-control" name="estacion" id="">
                @foreach ($estaciones as $item)
                <option value="{{$item->idEstacionDeTrabajo}}">{{$item->NombreEstacionDeTrabajo}}</option>    
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Fecha: <span class="text-danger">*</span></label>
            <input required type="date" class="form-control" name="fecha">
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="inputCampo1">Hora Ingreso: <span class="text-danger">*</span></label>
                        <div class="col">             
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-building"></i></span>
                                    <input required type="time" name="hora_ingreso" class="form-control">
                                </div>
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputCampo3">Hora inicio almuerzo: <span class="text-danger">*</span></label>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-hamburger"></i></span>
                                    <input required type="time" name="hora_inicio_almuerzo" class="form-control">
                                </div>
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="inputCampo1">Hora fin almuerzo: <span class="text-danger">*</span></label>
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-hamburger"></i></span>
                                    <input required type="time" name="hora_fin_almuerzo" class="form-control">
                                </div>
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputCampo3">Hora salida <span class="text-danger">*</span></label>
                        <div class="col">
                            <div class="form-group">     
                                <div class="input-group">
                                    <span class="span-cambio input-group-text bg-primary"><i class="fas fa-building"></i></span>
                                    <input required type="time" name="hora_salida" class="form-control">
                                </div>
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>    
          </div>
       </form>
      </div>
      </div>
    </div>
  </div>