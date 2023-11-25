<table class="table table-bordered table-hover">
    <thead class="bg-dark">
        <tr>
            <th colspan="4" class="text-center">Otros Documentos</th>
        </tr>
        <tr>
            <th>#</th>
            <th>Tipo Documento</th>
            <th>Fecha de registro</th>
            <th>Documento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($otros_documentos as $item)
            @if ($item->id_tipodocumento==10)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->comentario }}</td>
                    <td>{{ date('d/m/Y',strtotime($item->fecha_registro)) }}</td>
                    <td>
                        <a class="btn btn-light" href="{{ asset('storage').'/'.$item->documento }}" target="_blank">Ver documento</a>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>