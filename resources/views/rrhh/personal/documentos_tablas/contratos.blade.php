<table class="table table-bordered">
    <thead>
    <tr class="bg-primary">
      <th>Fecha de Inicio</th>
      <th>Fecha Fin </th>
      <th>Contrato</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($contratos as $contrato)
    <tr>
      <td>{{date('d/m/Y',strtotime($contrato->FechaDeInicioDeContrato))}}</td>
      <td>{{date('d/m/Y',strtotime($contrato->FechaDeFinDeContrato))}}</td>
      <td><a class="btn btn-light" href="{{ asset('storage/'.$contrato->contratopdf) }}">Ver contrato <i class="fas fa-eye"></i></a></td>
    </tr>
    @endforeach
  </tbody>
  </table>