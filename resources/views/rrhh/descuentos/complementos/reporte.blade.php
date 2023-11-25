    <div class="card">
        <div class="card-header bg-success">
            Reporte de descuentos 
        </div>
        <div class="card-body">
                <form id="form-descuentos" action="{{ route('buscar.descuento') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Seleccione periodo:</label>
                        <select class="form-control" name="periodo" id="" onchange="this.form.submit()">
                            <option hidden value="">Seleccione</option>
                            @foreach ($periodos as $item)
                                <option value="{{ $item->idPeriodo }}">{{ $item->NombrePeriodo }}</option>  
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-success">
                <b>Descuentos para el periodo</b>
            </div>
            @if  (isset($adelantos) && count($adelantos) > 0 || isset($prestamos) && count($prestamos) > 0 || isset($otros) && count($otros) > 0) 
        <div class="card-body">
        <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-hover" id="tabla-otros">
                        <thead>
                            <tr class="bg-warning text-center"> 
                                <th colspan="5">OTROS DESCUENTOS</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($otros as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->Nombres }}</td>
                                    <td>{{ date('d/m/Y',strtotime($item->fecha)) }}</td>
                                    <td>{{ $item->monto }}</td>
                                    <td class="text-center"><button data-option="1" data-id="{{ $item->idOtrosDescuentos }}" class="btn btn-danger btn-sm btn-eliminar-descuento"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-hover" id="tabla-prestamos">
                        <thead>
                            <tr class="bg-warning text-center"> 
                                <th colspan="5">PRÉSTAMOS</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prestamos as $item)
                            <tr>
                               <td>{{ $loop->iteration }}</td> 
                               <td>{{ $item->Nombres }}</td>
                               <td>{{ date('d/m/Y',strtotime($item->fecha)) }}</td>
                               <td>{{ $item->monto }}</td>
                               <td class="text-center"><button data-option="2" data-id="{{ $item->idPrestamo }}" class="btn btn-danger btn-sm btn-eliminar-descuento"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
         </div>
         <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover" id="tabla-adelantos">
                    <thead>
                        <tr class="bg-warning text-center"> 
                            <th colspan="6">ADELANTOS</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Documento</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($adelantos as $item)
                       <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $item->Nombres }}</td>
                           <td>{{ date('d/m/Y',strtotime($item->FechaDeDeposito)) }}</td>
                           <td>{{ $item->MontoAAdelantar }}</td>
                           <td> <a class="btn btn-primary btn-sm" href="{{ asset('storage').'/'.$item->LinkDeSolicitud }}" target="_blank">Ver documento</a></td>
                           <td class="text-center"><button data-option="3" data-id="{{ $item->idAdelanto }}" class="btn btn-danger btn-sm btn-eliminar-descuento"><i class="fas fa-trash"></i></button></td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
     </div>
    </div>
    @else
    <div class="card-body">
        <div class="alert alert-primary">
            No se encontraron resultados
        </div>
    </div>
    @endif
</div>
