@extends('adminlte::page')

@section('title', 'Tareos')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <h2><b>CALCULO DE CTS</b></h2>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('buscar.cts') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mes_cts">Seleccione mes: <span class="text-danger">*</span></label>
                        <select class="form-control" name="mes_cts" id="mes_cts">
                          <option hidden value="">Seleccione</option>
                          <option value="05">MAYO</option>
                          <option value="11">NOVIEMBRE</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="anio_cts">Digite año: <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="anio_cts" id="anio_cts" min="1900" max="2099" pattern="[0-9]{4}" placeholder="Ingrese un año válido (ejemplo: 2023)">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">Buscar</button>
            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-header bg-primary">
            <b>CALCULO DE TRABAJADORES PARA CTS</b>
            <button id="exportarExcelBtn" class="btn btn-success float-right">
                <i class="fas fa-file-excel"></i> Exportar a Excel
            </button>
        </div>
        @if  (isset($empleados) && count($empleados) > 0) 
        <div class="card-body">
            <table id="tablaCTS" class="table table-hover table-bordered table-responsive">
                <thead>
                    <tr class="bg-primary">
                        <th class="text-center" colspan="14">CALCULO CTS PARA {{ strtoupper(\Carbon\Carbon::parse($fechaEncabezado)->locale('es')->isoFormat('MMMM YYYY')) }}</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th class="text-center align-middle">Fecha de Inicio</th>
                        <th class="text-center align-middle">DNI</th>
                        <th class="text-center align-middle">Apellidos y Nombres</th>
                        @foreach ($fechas as $fecha)
                            @php
                                $fechaFormateada = \Carbon\Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->isoFormat('MMM YYYY');
                                $fechaFormateada = ucfirst($fechaFormateada);
                            @endphp
                        <th class="text-center align-middle">{{ $fechaFormateada }}</th>
                        @endforeach
                        <th class="text-center align-middle">SUBTOTAL</th>
                        <th class="text-center align-middle">1/6 Gratificacion anterior</th>
                        <th class="text-center align-middle">Base calculo CTS</th>
                        <th class="text-center align-middle">Factor de Calculo 0.8333</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $item)
                        @php
                            $suma_remuneraciones_fila = 0;
                        @endphp
                        <tr data-id="{{ $loop->iteration }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->FechaDeInicioDeContrato }}</td>
                            <td>{{ $item->DNI }}</td>
                            <td>{{ strtoupper($item->ApellidoPaterno.' '.$item->ApellidoMaterno.' '.$item->Nombres) }}</td>
                            @foreach ($fechas as $fecha)
                                <td>
                                    @php
                                        $remuneracion_asegurable = new \App\Http\Controllers\CTS\CtsController();
                                        $remuneracion_asegurable_value = $remuneracion_asegurable->RemuneracionAsegurable($item->idContrato, $fecha);
                                        echo $remuneracion_asegurable_value;
                                        $suma_remuneraciones_fila += $remuneracion_asegurable_value;
                                    @endphp
                                </td>
                            @endforeach
                            <td class="suma-remuneraciones">{{ $suma_remuneraciones_fila }}</td>
                            <td class="editable-cell" contenteditable="true"></td>
                            <td class="base-calculo"></td>
                            <td class="factor-calculo"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="card-body">
        <div class="alert alert-warning">
            No se encontraton resultados
        </div>
    </div>
    @endif

@stop

@section('js')
<script src="{{ asset('js/cts/calculo_cts.js') }}"></script>
<script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
@stop