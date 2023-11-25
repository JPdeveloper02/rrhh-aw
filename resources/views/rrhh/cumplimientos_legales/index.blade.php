@extends('adminlte::page')

@section('title', 'Cumplimientos legales')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <h2><b>CUMPLIMIENTOS LEGALES - DOCUMENTOS</b></h2>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-dark">
            <b>Cumplimientos legales</b>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table-documents">
                <thead>
                    <tr class="bg-dark">
                        <th>#</th>
                        <th>Empleado</th>
                        <th>Alta sunat</th>
                        <th>Adenda tarjeta de control</th>
                        <th>Adenda de tardanza</th>
                        <th>Declaración jurada de correo y celular</th>
                        <th>Declaración juarada de NO tener hijos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($item->ApellidoPaterno.' '.$item->ApellidoMaterno.' '.$item->Nombres) }}</td>
                        <td class="text-center">
                            {{-- Alta Sunat --}}
                            @php
                                $documentoEncontrado = null;
                            @endphp
                            @foreach ($documentos as $documento)
                                @if ($documento->id_empleado === $item->idEmpleado && $documento->id_tipodocumento === 3)
                                    @php
                                        $documentoEncontrado = $documento;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($documentoEncontrado)
                                <a  href="{{ asset('storage').'/'.$documento->documento }}" target="_blank" class="btn btn-success"><i class="fas fa-check"></i></a>
                            @else
                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- Adenda tarjeta control --}}
                            @php
                                $documentoEncontrado = null;
                            @endphp
                            @foreach ($documentos as $documento)
                                @if ($documento->id_empleado === $item->idEmpleado && $documento->id_tipodocumento === 11)
                                    @php
                                        $documentoEncontrado = $documento;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($documentoEncontrado)
                                <a  href="{{ asset('storage').'/'.$documento->documento }}" target="_blank" class="btn btn-success"><i class="fas fa-check"></i></a>
                            @else
                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- Adenda tardanza --}}
                            @php
                            $documentoEncontrado = null;
                            @endphp
                            @foreach ($documentos as $documento)
                                @if ($documento->id_empleado === $item->idEmpleado && $documento->id_tipodocumento === 4)
                                    @php
                                        $documentoEncontrado = $documento;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($documentoEncontrado)
                                <a  href="{{ asset('storage').'/'.$documento->documento }}" target="_blank" class="btn btn-success"><i class="fas fa-check"></i></a>
                            @else
                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- DJ de correo y celular --}}
                            @php
                            $documentoEncontrado = null;
                            @endphp
                            @foreach ($documentos as $documento)
                                @if ($documento->id_empleado === $item->idEmpleado && $documento->id_tipodocumento === 1)
                                    @php
                                        $documentoEncontrado = $documento;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($documentoEncontrado)
                                <a  href="{{ asset('storage').'/'.$documento->documento }}" target="_blank" class="btn btn-success"><i class="fas fa-check"></i></a>
                            @else
                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- DJ de NO tener hijos --}}
                            @php
                            $documentoEncontrado = null;
                            @endphp
                            @foreach ($documentos as $documento)
                                @if ($documento->id_empleado === $item->idEmpleado && $documento->id_tipodocumento === 2)
                                    @php
                                        $documentoEncontrado = $documento;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($documentoEncontrado)
                                <a  href="{{ asset('storage').'/'.$documento->documento }}" target="_blank" class="btn btn-success"><i class="fas fa-check"></i></a>
                            @else
                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('js')
<script>
     $('#table-documents').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
    });
</script>
@stop