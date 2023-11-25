<div class="card">
    <div class="card-header">
        <b>Registro de horas extras</b>
    </div>
    <div class="card-body">
      <form action="" method="POST">
          @csrf
          <div class="form-group">
            <select class="form-control select_personal" onchange="openModalHE(this)" data-modal-target="#horas_extras" data-id-contrato="">
                <option hidden value=""></option>
                @foreach ($personas as $item)
                <option value="{{$item->idContrato}}">{{ strtoupper($item->Nombres.' '.$item->ApellidoPaterno.' '.$item->ApellidoMaterno) }}</option>
                @endforeach
            </select>
          </div>
      </form>
    </div>
  </div>