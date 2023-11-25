<div class="card">
    <div class="card-header">
        <b>Registro de Tareo por persona</b>
    </div>
    <div class="card-body">
      @if(session('error'))
      <script>
          // Espera a que el DOM esté cargado antes de mostrar la alerta
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: '{{ session('error') }}',
              });
          });
      </script>
    @endif
    @if(session('success'))
    <script>
        // Espera a que el DOM esté cargado antes de mostrar la alerta
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
            });
        });
    </script>
  @endif
          <div class="form-group">
            <select class="form-control select_personal" onchange="openModalIndividual(this)" data-modal-target="#tareo_individual">
                <option hidden value=""></option>
                @foreach ($personas as $item)
                <option value="{{$item->idContrato}}">{{ strtoupper($item->Nombres.' '.$item->ApellidoPaterno.' '.$item->ApellidoMaterno) }}</option>
                @endforeach
            </select>
          </div>
    </div>
  </div>