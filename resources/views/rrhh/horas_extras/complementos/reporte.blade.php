<div class="card">
    <div class="card-header bg-success">
        Reporte de horas extras 
    </div>
    <div class="card-body">
            <form id="form-descuentos" action="{{ route('buscar.horasextras') }}" method="POST">
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
            <b>HORAS EXTRAS</b>
        </div>
        @if  (isset($horas_extras) && count($horas_extras) > 0) 
    <div class="card-body">
                <table class="table table-bordered table-hover" id="tabla-otros">
                    <thead>
                        <tr class="bg-warning text-center"> 
                            <th colspan="6">HORAS EXTRAS PERIODO - {{ $nombre_periodo }}</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Fecha</th>
                            <th>Valor de 25 (minutos)</th>
                            <th>Valor de 35 (minutos)</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horas_extras as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ strtoupper($item->Nombres.' '.$item->ApellidoPaterno.' '.$item->ApellidoMaterno) }}</td>
                                <td>{{ date('d/m/Y',strtotime($item->HoraDeRegistro)) }}</td>
                               <td>{{ $item->ValorDe25 }} min</td>
                               <td>{{ $item->ValorDe35 }} min</td>
                               <td class="text-center"><button data-option="1" data-id="{{ $item->idHorasExtras }}" class="btn btn-danger btn-sm btn-eliminar-horasextras"><i class="fas fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
</div>
@else
<div class="card-body">
    <div class="alert alert-primary">
        No se encontraron resultados
    </div>
</div>
@endif
</div>
