<table class="table table-bordered">
    <thead>
    <tr class="bg-primary">
      <th>Fecha de Inicio</th>
      <th>Fecha Fin </th>
      <th>Contrato</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($licencias as $licencia)
    <tr>
      <td>{{date('d/m/Y',strtotime($licencia->FechaDeInicioConGoceDeHaber))}}</td>
      <td>{{date('d/m/Y',strtotime($licencia->FechaDeFinConGoceDeHaber))}}</td>
      <td><a class="btn btn-light" href="{{ asset('storage/'.$licencia->linkDelDocumento) }}">Ver contrato <i class="fas fa-eye"></i></a></td>
    </tr>
    @endforeach
  </tbody>
  </table>