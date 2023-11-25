<h4><b>{{ strtoupper($empleado->Nombres.' '.$empleado->ApellidoPaterno.' '.$empleado->ApellidoMaterno) }} </b></h4>
<hr>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#cursos" role="tab" aria-controls="pills-home" aria-selected="true">Cursos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#examenes" role="tab" aria-controls="pills-profile" aria-selected="false">Exámenes</a>
    </li>
  </ul>

  {{-- CURSOS --}}
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="cursos" role="tabpanel" aria-labelledby="pills-home-tab">
      <form action="{{ route('habilitacion.empleado') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input hidden type="number" value="1" name="opcion">
        <input hidden type="number" name="idEmpleado" value="{{ $empleado->idEmpleado }}">
        <div class="row">
          <div class="col-6">
              <label for="">Estación: <span class="text-danger">*</span></label>
              <select disabled required class="form-control" name="estacion_trabajo" id="estacion_select">
                  @foreach ($estaciones as $item)
                      <option value="{{ $item->idEstacionDeTrabajo }}" @if ($item->idEstacionDeTrabajo == $empleado->idEstacionDeTrabajo) selected @endif>
                          {{ $item->NombreEstacionDeTrabajo }}
                      </option>
                  @endforeach
              </select>
              <small>Aparecerá por default la estación del trabajador</small>
          </div>
          <div class="col-6">
              <label for="">Seleccione curso: <span class="text-danger">*</span></label>
              <select required class="form-control" name="cursos" id="curso_select">
                  <option hidden value="">Seleccione</option>
                  @foreach ($cursos_empleado as $item)
                      <option value="{{ $item->idCursoDeHabilitacion }}">{{ $item->NombreCursoDeHabilitacion }}</option>
                  @endforeach
              </select>
          </div>
      </div>

        <div class="row mt-4">
          <div class="col-6">
            <label for="">Fecha de realización: <span class="text-danger">*</span></label>
            <input required class="form-control" type="date" name="fecha_realizacion">
          </div>
          <div class="col-6">
            <label for="">Fecha de vencimiento: <span class="text-danger">*</span></label>
            <input required type="date" class="form-control" name="fecha_vencimiento">
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-6">
            <label for="">Documento: <span class="text-danger">*</span></label>
            <input required type="file" class="form-control" name="documento">
          </div>
        </div>

        <button type="submit" class="btn btn-success mt-4">Registrar</button>
      </form>
      @include('rrhh.habilitaciones.complementos.listado')
    </div>
    
    {{-- EXAMENES --}}
    <div class="tab-pane fade" id="examenes" role="tabpanel" aria-labelledby="pills-profile-tab">
      <form action="{{ route('habilitacion.empleado') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input hidden type="number" value="2" name="opcion">
        <input hidden type="number" name="idEmpleado" value="{{ $empleado->idEmpleado }}">
        <div class="row">
          <div class="col-6">
            <label for="">Seleccione tipo examen: <span class="text-danger">*</span></label>
            <select required class="form-control" name="tipo_examen" id="">
              <option hidden value="">Seleccione</option>
              @foreach ($examenes as $item)
                  <option value="{{ $item->idTipoExamenMedico }}">{{ $item->NombreTipoExamenMedico }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-6">
            <label for="">Fecha de realización: <span class="text-danger">*</span></label>
            <input required class="form-control" type="date" name="fecha_realizacion">
          </div>
          <div class="col-6">
            <label for="">Fecha de vencimiento: <span class="text-danger">*</span></label>
            <input required type="date" class="form-control" name="fecha_vencimiento">
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-6">
            <label for="">Documento: <span class="text-danger">*</span></label>
            <input required type="file" class="form-control" name="documento">
          </div>
        </div>

        <button type="submit" class="btn btn-success mt-4">Registrar</button>
      </form>
      @include('rrhh.habilitaciones.complementos.listado')
    </div>
  </div>