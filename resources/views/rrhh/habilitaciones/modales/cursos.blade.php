<div class="modal fade" id="nuevo_curso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de nuevo curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#curso" role="tab" aria-controls="home" aria-selected="true">Crear Curso</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#asignar" role="tab" aria-controls="profile" aria-selected="false">Asignar Estacion a Curso</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          {{-- Nuevo Curso --}}
          <div class="tab-pane fade show active" id="curso" role="tabpanel" aria-labelledby="home-tab">
            <form action="{{ route('cursos') }}" method="POST">
              @csrf
              <input hidden type="number" name="opcion" value="1">
              <div class="form-group mt-2">
                <label for="descripcion_curso">Nombre del curso <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" name="nombre_curso">
              </div>
              <div class="form-group">
                <label for="nombre_curso">Selección para que estación(es) es el curso: <span class="text-danger">*</span></label>
                <select required class="form-control select_cursos" name="estacion_trabajo" id="">
                  <option value=""></option>
                  @foreach ($estaciones as $item)
                      <option value="{{ $item->idEstacionDeTrabajo }}">{{ $item->NombreEstacionDeTrabajo }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
          </div>
          {{-- Asignar curso existente a estacion --}}
          <div class="tab-pane fade" id="asignar" role="tabpanel" aria-labelledby="profile-tab">
            <form action="{{ route('cursos') }}" method="POST">
              @csrf
              <input hidden type="number" name="opcion" value="2" id="">
              <div class="form-group mt-2">
                <label for="nombre_curso">Seleccione curso: <span class="text-danger">*</span></label>
                <select required class="form-control select_cursos" name="cursos" id="">
                  <option value=""></option>
                  @foreach ($cursos as $item)
                      <option value="{{ $item->idCursoDeHabilitacion }}">{{ $item->NombreCursoDeHabilitacion }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="nombre_curso">Selección estación: <span class="text-danger">*</span></label>
                <select required class="form-control select_cursos" name="estacion_trabajo" id="">
                  <option value=""></option>
                  @foreach ($estaciones as $item)
                      <option value="{{ $item->idEstacionDeTrabajo }}">{{ $item->NombreEstacionDeTrabajo }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
          </div>
        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>