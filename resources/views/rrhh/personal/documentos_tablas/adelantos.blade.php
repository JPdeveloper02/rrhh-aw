<table class="table table-bordered">
    <thead>
    <tr class="bg-primary">
      <th>Fecha</th>
      <th>Monto</th>
      <th>Documento</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($adelantos as $adelanto)
    <tr>
      <td>{{date('d/m/Y',strtotime($adelanto->FechaDeDeposito))}}</td>
      <td>{{date('d/m/Y',strtotime($adelanto->MontoAAdelantar))}}</td>
      <td><a class="btn btn-light" href="{{ asset('storage/'.$adelanto->LinkDeSolicitud) }}">Ver Adelanto <i class="fas fa-eye"></i></a></td>
    </tr>
    @endforeach
  </tbody>
  </table>