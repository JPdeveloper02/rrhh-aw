<div class="card">
    <div class="card-header text-right">
      <button class="btn btn-success ml-auto" data-toggle="modal" data-target="#modalEditarDatosProfesionales">Editar Datos <i class="fas fa-edit"></i></button>
    </div>
      <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <i class="fas fa-file-signature text-primary "></i>
                    <label for="nombre" class="badge badge-primary">Fecha Inicio de Contrato:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre" value="{{ date('d/m/Y',strtotime($persona->FechaDeInicioDeContrato)) }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <i class="fas fa-file-signature text-primary "></i>
                    <label for="nombre"  class="badge badge-primary">Fecha fin de Contrato:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre" value="{{ date('d/m/Y',strtotime($persona->FechaDeFinDeContrato)) }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <i class="fas fa-briefcase text-primary"></i>
                    <label for="nombre" class="badge badge-primary">Cargo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre" value="{{ $persona->NombreCargo }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                      <i class="fas fa-user-lock text-primary"></i>
                      <label for="nombre" class="badge badge-primary">Fondo de Pensión:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="nombre" value="{{ $persona->NombreEntidad }}" readonly>
                    </div>
                  </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <i class="fas fa-building text-primary"></i>
                    <label for="nombre" class="badge badge-primary">Estación de trabajo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre" value="{{ $persona->NombreEstacionDeTrabajo }}" readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-4">
                    <i class="fas fa-money-check-alt text-primary"></i>
                    <label for="nombre" class="badge badge-primary">Sueldo Base:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre" value="S/{{ $persona->SueldoBase }}" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <i class="fas fa-baby text-primary"></i>
                    <label for="nombre" class="badge badge-primary">Pension alimenticia:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nombre" value="{{ $persona->pensionAlimenticia }}" readonly>
                  </div>
                </div>
              </div>
            </div>
      </div>
  </div>  