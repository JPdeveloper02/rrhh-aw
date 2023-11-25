<div class="card">
    <div class="card-header bg-success">

    </div>
    <div class="card-body">
        <div class="form-group">
        <label for="">Seleccione persona para registrar descuento:</label>
        <select class="form-control select_personal" onchange="openModalDescuentos(this)" data-modal-target="#registro_descuentos">
            <option hidden value=""></option>
            @foreach ($personas as $item)
            <option value="{{$item->idContrato}}">{{ strtoupper($item->Nombres.' '.$item->ApellidoPaterno.' '.$item->ApellidoMaterno) }}</option>
            @endforeach
        </select>
    </div>
    </div>
</div>