@if(session('success_pruebatareo'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Registro éxitoso!</strong> {{ session('success_pruebatareo') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if(session('error_pruebatareo'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error_pruebatareo') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif