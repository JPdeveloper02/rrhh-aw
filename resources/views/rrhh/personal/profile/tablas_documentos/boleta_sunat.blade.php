<table class="table table-bordered table-hover">
    <thead class="bg-dark">
        <tr>
            <th colspan="3" class="text-center">Boleta Sunat</th>
        </tr>
        <tr>
            <th>#</th>
            <th>Fecha de registro</th>
            <th>Documento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($otros_documentos as $item)
            @if ($item->id_tipodocumento==8)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d/m/Y',strtotime($item->fecha_registro)) }}</td>
                    <td>
                        <a class="btn btn-light" href="{{ asset('storage').'/'.$item->documento }}" target="_blank">Ver documento</a>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>