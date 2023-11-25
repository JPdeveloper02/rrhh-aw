@extends('adminlte::page')

@section('title', 'Dias tareados')
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

@section('content_header')
    <link rel="stylesheet" href="{{ asset('css/dias_tareados.css') }}">
    <h2><b>TAREADO DE TODOS LOS TRABAJADORES</b></h2>
@stop

@section('content')

<div class="card">
    <div class="card-header bg-success">
        
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <table class="table table-bordered table-hover table-responsive" id="tablaDiasTareados">
                <thead>
                    <tr class="bg-primary">
                        <th>#</th>
                        <th>Trabajador</th>
                        @php
                            $fechaInicial = new DateTime($periodo->DiaDeInicioDelPeriodo);
                            $fechaFinal = new DateTime($periodo->DiaDeFinDelPeriodo);
                            $intervalo = new DateInterval('P1D');
                            $fechaActual = clone $fechaInicial;
                        @endphp
                        @for ($date = $fechaInicial; $date <= $fechaFinal; $date->add($intervalo))
                            @php
                                $domingo = Carbon\Carbon::parse($fechaActual);
                                $domingo = $domingo->dayOfWeek === Carbon\Carbon::SUNDAY;
                            @endphp
                                @if($domingo)
                                    <th class="bg-danger text-center">{{ $fechaActual->format('d') }}</th>
                                @else
                                <th class="text-center">
                                    <button class="btn btn-primary">{{ $fechaActual->format('d') }}</button>
                                  </th>
                                @endif
                            @php
                                $fechaActual->add($intervalo);
                            @endphp
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @php
                        $personasImpresas = [];
                        $contador = 1;
                    @endphp
                    
                @foreach($tareos as $tareo)
                    @if (!in_array($tareo->idContrato, $personasImpresas))
                        <tr>
                            <th class="p-0 text-center align-middle"></th>
                            <td class="py-0 px-2 bg-primary sticky-column">
                                {{ strtoupper(explode(' ', $tareo->Nombres)[0].' '.$tareo->ApellidoPaterno) }}
                            </td>
                            @php
                                $fechaInicial = new DateTime($periodo->DiaDeInicioDelPeriodo);
                                $fechaFinal = new DateTime($periodo->DiaDeFinDelPeriodo);
                                $intervalo = new DateInterval('P1D');
                                $fechaActual = clone $fechaInicial;
                                $fechaEncontrada = false;
                            @endphp
                
                            @for ($date = Carbon\Carbon::parse($fechaInicial); $date <= $fechaFinal; $date->add($intervalo))
                                @php
                                    $esDomingo = $date->dayOfWeek === Carbon\Carbon::SUNDAY;
                                @endphp
                                @if ($esDomingo)
                                    <td class="text-center align-middle p-0 bg-danger">    
                                @else
                                    <td class="text-center align-middle p-0">    
                                @endif
                                
                                @foreach ($diasTareados as $item)
                                    @if ($tareo->idContrato == $item->idContrato && $item->Fecha == $date)   
                                            @php
                                                $tiempo = tiempoTrabajado($item->HoraDeIngreso, $item->HoraDeSalida, $item->HoraDeInicioDeAlmuerzo, $item->HoraDeFinDeAlmuerzo);
                                                $diaDeLaSemana = Carbon\Carbon::parse($item->Fecha);
                                                $esSabado = $diaDeLaSemana->dayOfWeek === Carbon\Carbon::SATURDAY;
                                                $regimen_laboral = $item->idRegimenLaboral;
                                                $idCondicion = $item->idCondicionDeTareo;
                                            @endphp
                                            {{-- EVALUAMOS SI ES SABADO PARA IMPRIMIR AMARILLO SI ES TARDE O VERDE SI ES TEMPRANO --}}
                                            @if (in_array($regimen_laboral, [1]))
                                                @if ($esSabado)
                                                    @if (strtotime($tiempo) >= strtotime('05:30:00'))
                                                        <button type="button" class="btn btn-success btn-sm p-0 btn-tareo" data-toggle="modal" data-nombres="{{ strtoupper($tareo->Nombres.' '.$tareo->ApellidoPaterno.' '.$tareo->ApellidoMaterno) }}" data-target="#tareoModal" data-tareo="{{ $item->idTareo }}" data-fecha="{{ $item->Fecha->format('Y-m-d') }}">
                                                            {{ $tiempo }}
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-warning btn-sm p-0 btn-tareo" data-toggle="modal" data-nombres="{{ strtoupper($tareo->Nombres.' '.$tareo->ApellidoPaterno.' '.$tareo->ApellidoMaterno) }}" data-target="#tareoModal" data-tareo="{{ $item->idTareo }}" data-fecha="{{ $item->Fecha->format('Y-m-d') }}">
                                                            {{ $tiempo }}
                                                        </button>
                                                    @endif
                                                @else
                                                    @if (strtotime($tiempo) >= strtotime('08:30:00'))
                                                        <button type="button" class="btn btn-success btn-sm p-0 btn-tareo" data-toggle="modal" data-nombres="{{ strtoupper($tareo->Nombres.' '.$tareo->ApellidoPaterno.' '.$tareo->ApellidoMaterno) }}" data-target="#tareoModal" data-tareo="{{ $item->idTareo }}" data-fecha="{{ $item->Fecha->format('Y-m-d') }}">
                                                            {{ $tiempo }}
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-warning btn-sm p-0 btn-tareo" data-toggle="modal" data-nombres="{{ strtoupper($tareo->Nombres.' '.$tareo->ApellidoPaterno.' '.$tareo->ApellidoMaterno) }}" data-target="#tareoModal" data-tareo="{{ $item->idTareo }}" data-fecha="{{ $item->Fecha->format('Y-m-d') }}">
                                                            {{ $tiempo }}
                                                        </button>
                                                    @endif
                                                @endif
                                            @else
                                            <button type="button" class="btn btn-success btn-sm btn-tareo" data-toggle="modal" data-nombres="{{ strtoupper($tareo->Nombres.' '.$tareo->ApellidoPaterno.' '.$tareo->ApellidoMaterno) }}" data-target="#tareoModal" data-tareo="{{ $item->idTareo }}" data-fecha="{{ $item->Fecha->format('Y-m-d') }}">
                                                @php
                                                    $leyendaTareo = new \App\Http\Controllers\Tareos\TareoController();
                                                    $leyendaTareo_value = $leyendaTareo->leyendaTareo($idCondicion);
                                                    echo $leyendaTareo_value;
                                                @endphp
                                            </button>
                                            @endif
                                        
                                        @php
                                            $fechaEncontrada = true;
                                        @endphp
                                    @endif    
                                @endforeach
                                @if(!$fechaEncontrada)
                                    <button type="button" class="btn btn-outline-dark btn-sm p-1 btn-tareo" data-toggle="modal" data-target="#tareoModal" data-contrato="{{ $tareo->idContrato }}" data-fecha="{{ $date->format('Y-m-d') }}">
                                        <span class="text-white">NR</span>
                                    </button>
                                @endif
                                    @php
                                        $fechaEncontrada = false;    
                                    @endphp
                                </td>
                            @endfor    
                        </tr>
                        @php
                            $personasImpresas[] = $tareo->idContrato;
                            $contador++;
                        @endphp
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@include('rrhh.tareos.dias_tareados.modales.ver_tareo')
@include('rrhh.tareos.dias_tareados.modales.tareo')
@stop

@section('js')
    <script src="{{asset('js/tareos/diastareados.js')}}"></script>
    <script src="{{ asset('js/tareos/mostrar_foto.js') }}"></script>
    <script src="
https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js
"></script>
    <script>
        const csrfToken = "{{ csrf_token() }}"
        const buscarTareoId = "{{ route('buscarTareoId') }}"
        const guardarEditarTareo = "{{ route('guardarEditarTareo') }}"
        const eliminarTareo = "{{ route('eliminarTareo') }}"

        $('#tablaDiasTareados').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
        });

    </script>
@stop