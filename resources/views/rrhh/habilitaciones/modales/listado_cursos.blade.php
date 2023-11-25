<div class="modal fade" id="listado_curso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>LISTADO DE CURSOS ASIGNADOS A UN PROYECTO</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($estaciones as $index => $item)
                        <li class="nav-item">
                            <a class="nav-link{{ $index === 0 ? ' active' : '' }}" id="{{ 'tab-' . $item->idEstacionDeTrabajo }}" data-toggle="tab" href="{{ '#content-' . $item->idEstacionDeTrabajo }}" role="tab" aria-controls="{{ 'tab-' . $item->idEstacionDeTrabajo }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $item->NombreEstacionDeTrabajo }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            
                <div class="tab-content" id="myTabContent">
                    @foreach ($estaciones as $index => $estacion)
                        <div class="tab-pane fade{{ $index === 0 ? ' show active' : '' }}" id="{{ 'content-' . $estacion->idEstacionDeTrabajo }}" role="tabpanel" aria-labelledby="{{ 'tab-' . $estacion->idEstacionDeTrabajo }}">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-success text-light text-center">
                                        <th class="text-center" colspan="2" id="{{ 'estacion-nombre-' . $estacion->idEstacionDeTrabajo }}">ESTACIÓN {{ $estacion->NombreEstacionDeTrabajo }}</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>  
                                        <th>Cursos asignados a estación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $iteration=1;
                                    @endphp
                                    @foreach ($cursos as $curso)
                                        @if ($estacion->idEstacionDeTrabajo == $curso->id_estacionTrabajo)
                                            <tr>
                                                <td>{{ $iteration++ }}</td>
                                                <td>{{ $curso->NombreCursoDeHabilitacion }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>