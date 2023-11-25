<div class="card mt-4">
    <div class="card-header bg-primary">
        Listado de Cursos y Exámenes
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" class="text-center">CURSOS</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Curso</th>
                            <th>Fecha de curso</th>
                            <th>Fecha de vencimiento</th>
                            <th>Documento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listado_cursos as $cursos)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cursos->NombreCursoDeHabilitacion }}</td>
                            <td>{{ date('d/m/Y',strtotime($cursos->fecha_inicio)) }}</td>
                            <td>{{ date('d/m/Y',strtotime($cursos->fecha_vencimiento)) }}</td>
                            <td><a href="{{ asset('storage').'/'.$cursos->documento }}" target="_blank" class="btn btn-primary"><i>Ver</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" class="text-center">EXAMENES</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Examen</th>
                            <th>Fecha de exámen</th>
                            <th>Fecha de vencimiento</th>
                            <th>Documento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listado_examenes as $examen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $examen->NombreTipoExamenMedico }}</td>
                            <td>{{ date('d/m/Y',strtotime($examen->FechaDeInicioVigencia)) }}</td>
                            <td>{{ date('d/m/Y',strtotime($cursos->FechaDeFinVidencia)) }}</td>
                            <td><a href="{{ asset('storage').'/'.$examen->documento }}" target="_blank" class="btn btn-primary"><i>Ver</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>