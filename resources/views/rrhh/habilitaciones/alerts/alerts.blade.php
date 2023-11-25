@if(session('success_cursos'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Registro éxitoso!</strong> {{ session('success_cursos') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(session('error_cursos'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error_cursos') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(session('success_habilitacion'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Registro éxitoso!</strong> {{ session('success_habilitacion') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(session('error_habilitacion'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong>{{ session('error_habilitacion') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif