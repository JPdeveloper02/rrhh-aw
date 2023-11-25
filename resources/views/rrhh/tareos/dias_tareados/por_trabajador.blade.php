@extends('adminlte::page')

@section('title', 'Dias tareados')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <h2><b>TAREO POR TRABAJADOR</b></h2>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-success">
            <b>TRABAJADOR: {{  strtoupper($empleado->Nombres.' '.$empleado->ApellidoPaterno.' '.$empleado->ApellidoMaterno)  }}</b>
        </div>
        <div class="card-body">
            @php
                $diasSemana = [
                    'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
                ];
            @endphp

            <table id="table_diastareados_trabajador" class="table table-hover table-bordered">
                <thead>
                    <tr class="bg-success">
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Día</th> <!-- Nueva columna -->
                        <th>Hora de entrada</th>
                        <th>Hora de inicio Almuerzo</th>
                        <th>Hora fin Almuerzo</th>
                        <th>Hora salida</th>
                        <th>Condicion de Tareo</th>
                        <th>Estacion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tareos as $item)
                        <tr @if (date('N', strtotime($item->Fecha)) == 7) class="bg-danger" @endif>
                            <td></td>
                            <td>{{ date('d/m/Y', strtotime($item->Fecha)) }}</td>
                            <td>{{ $diasSemana[date('w', strtotime($item->Fecha))] }}</td> <!-- Nueva columna -->
                            <td>{{ date('H:i', strtotime($item->HoraDeIngreso)) }}</td>
                            <td>{{ date('H:i', strtotime($item->HoraDeInicioDeAlmuerzo)) }}</td>
                            <td>{{ date('H:i', strtotime($item->HoraDeFinDeAlmuerzo)) }}</td>
                            <td>{{ date('H:i', strtotime($item->HoraDeSalida)) }}</td>
                            <td>{{ $item->NombreCondicionDeTareo }}</td>
                            <td>{{ $item->NombreEstacionDeTrabajo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script>
     $('#table_diastareados_trabajador').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
    });
</script>
@stop