<table class="table table-bordered table-hover">
    <thead class="bg-dark">
        <tr>
            <th colspan="4" class="text-center">Licencias CON Goce</th>
        </tr>
        <tr>
            <th>#</th>
            <th>Fecha Inicio de con Goce de Haber</th>
            <th>Fecha Fin de con Goce de Haber</th>
            <th>Documento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($licencias_con as $lc)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d/m/Y',strtotime($lc->FechaDeInicioConGoceDeHaber)) }}</td>
                    <td>{{ date('d/m/Y',strtotime($lc->FechaDeFinConGoceDeHaber)) }}</td>
                    <td>
                        <a class="btn btn-light" href="{{ asset('storage').'/'.$lc->LinkDelDocumento }}" target="_blank">Ver documento</a>
                    </td>
                </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
    <thead class="bg-dark">
        <tr>
            <th colspan="4" class="text-center">Licencias SIN Goce</th>
        </tr>
        <tr>
            <th>#</th>
            <th>Fecha Inicio de sin Goce de Haber</th>
            <th>Fecha Fin de sin Goce de Haber</th>
            <th>Documento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($licencias_sin as $ls)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d/m/Y',strtotime($ls->FechaDeInicioSinGoceDeHaber)) }}</td>
                    <td>{{ date('d/m/Y',strtotime($ls->FechaDeFinSinGoceDeHaber)) }}</td>
                    <td>
                        <a class="btn btn-light" href="{{ asset('storage').'/'.$ls->LinkDelDocumento }}" target="_blank">Ver documento</a>
                    </td>
                </tr>
        @endforeach
    </tbody>
</table>