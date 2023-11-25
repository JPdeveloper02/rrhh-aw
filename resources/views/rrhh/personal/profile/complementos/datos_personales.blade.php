<div class="card">
  <div class="card-header text-right">
    <button style="display: none;" class="btn-guardar-perfil-personal btn btn-warning">Guardar <i class="fas fa-save"></i></button>
    <button class="btn-editar-perfil-personal btn btn-success ml-auto" data-toggle="modal" data-target="#modalEditarDatos">Editar Datos <i class="fas fa-edit"></i></button>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <div style="display: none" class="form-group row div-nombrecompleto">
          <div class="col-sm-4">
            <i class="fas fa-user text-primary"></i>
            <label for="dni" class="badge badge-primary">Nombre completo:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="nombre" value="{{ strtoupper($persona->Nombres) }}" readonly>
          </div>
        </div>
        <div style="display: none" class="form-group row div-nombrecompleto">
          <div class="col-sm-4">
            <i class="fas fa-user text-primary"></i>
            <label for="dni" class="badge badge-primary">Apellido paterno:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="apellidoPaterno" value="{{ strtoupper($persona->ApellidoPaterno) }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-user text-primary"></i>
            <label for="dni" class="badge badge-primary">DNI:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="dni" value="{{ $persona->DNI }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-phone-alt text-primary"></i>
            <label for="numeroCelular" class="badge badge-primary">Número de celular:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="numeroCelular" value="{{ $persona->Telefono }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-home text-primary"></i>
            <label for="direccion" class="badge badge-primary">Dirección:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="direccion" value="{{ $persona->direccion }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-birthday-cake text-primary"></i>
            <label for="fechaNacimiento" class="badge badge-primary">Fecha de Nacimiento:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="fechaNacimiento" value="{{ date('d/m/Y',strtotime($persona->FechaDeNacimiento)) }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-envelope text-primary"></i>
            <label for="email" class="badge badge-primary">Email:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="email" value="{{ $persona->Email }}" readonly>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div style="display: none" class="form-group row div-nombrecompleto">
          <div class="col-sm-4">
            <i class="fas fa-user text-primary"></i>
            <label for="dni" class="badge badge-primary">Apellido materno:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="apellidoMaterno" value="{{ strtoupper($persona->ApellidoMaterno) }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-crutch text-primary"></i>
            <label for="tipoSangre" class="badge badge-primary">Tipo de Sangre:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="tipoSangre" value="{{ $persona->NombreTipoDeSangre }}" readonly>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-viruses text-primary"></i>
            <label for="alergias" class="badge badge-primary">Alergias:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="alergias" value="{{ $persona->Alergias }}" readonly>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-user text-primary"></i>
            <label for="contactoEmergencia" class="badge badge-primary">Contacto de Emergencia:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="contactoEmergencia" value="{{ $persona->ContactoDeEmergencia }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-phone-alt text-primary"></i>
            <label for="numeroContacto" class="badge badge-primary">Número de contacto:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="numeroContacto" value="{{ $persona->NumeroDeEmergencia }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4">
            <i class="fas fa-child text-primary"></i>
            <label for="numeroHijos" class="badge badge-primary">Numero hijos:</label>
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="numeroHijos" value="{{ $persona->NHijos }}" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>