<table class="table table-bordered">
    <thead>
    <tr class="bg-primary">
      <th>Fecha de Inicio</th>
      <th>Fecha Fin </th>
      <th>Contrato</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($descansos_m as $descansos)
    <tr>
      <td>{{date('d/m/Y',strtotime($descansos->FechaDeInicioDescansoMedico))}}</td>
      <td>{{date('d/m/Y',strtotime($descansos->FechaDeFinDescansoMedico))}}</td>
      <td><a class="btn btn-light" href="{{ asset('storage/'.$licencia->LinkDocumento) }}">Ver Descanso Médico <i class="fas fa-eye"></i></a></td>
    </tr>
    @endforeach
  </tbody>
  </table>