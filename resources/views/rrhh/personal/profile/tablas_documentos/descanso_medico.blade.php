<table class="table table-bordered table-hover">
    <thead class="bg-dark">
        <tr>
            <th colspan="4" class="text-center">Descansos Médicos de trabajador</th>
        </tr>
        <tr>
            <th>#</th>
            <th>Fecha Inicio de Descanso Médico</th>
            <th>Fecha Fin de Descanso</th>
            <th>Documento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($descansos_medicos as $dm)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d/m/Y',strtotime($dm->FechaDeInicioDescansoMedico)) }}</td>
                    <td>{{ date('d/m/Y',strtotime($dm->FechaDeFinDescansoMedico)) }}</td>
                    <td>
                        <a class="btn btn-light" href="{{ asset('storage').'/'.$item->documento }}" target="_blank">Ver documento</a>
                    </td>
                </tr>
        @endforeach
    </tbody>
</table>