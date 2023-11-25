<div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-danger">
                  <b>CONTRATOS VENCIDOS</b>
                </div>
                <div class="card-body" style="height: 200px; overflow-y: scroll;">
                  <table class="table table-bordered table-hover w-100">
                    <thead>
                      <tr class="bg-danger">
                        <th class="p-1">#</th>
                        <th class="p-1">Trabajador</th>
                        <th class="p-1">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($vencidos as $vencido)
                      <tr>
                        <td class="p-1">{{ $loop->iteration }}</td>
                        <td class="p-1">{{ $vencido->Nombres }}<i class="fas fa-arrow-right">{{ $vencido->FechaDeFinDeContrato }} </i></td>
                        <td class="p-1 text-center"><a href="{{ url('personal/contrato/'.$vencido->idContrato) }}" class="btn btn-primary btn-sm">Renovar</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-warning">
                  <b>CONTRATOS A VENCER A 30 DÍAS</b>
                </div>
                <div class="card-body" style="height: 200px; overflow-y: scroll;">
                  <table class="table table-bordered table-hover w-100">
                    <thead>
                      <tr class="bg-warning">
                        <th class="p-1">#</th>
                        <th class="p-1">Trabajador</th>
                        <th class="p-1">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($treinta_dias as $treinta)
                      <tr>
                        <td class="p-1">{{ $loop->iteration }}</td>
                        <td class="p-1">{{ $treinta->Nombres }} <i class="fas fa-arrow-right">{{ $treinta->FechaDeFinDeContrato }}</i></td>
                        <td class="p-1 text-center"><a href="{{ url('personal/contrato/'.$treinta->idContrato) }}" class="btn btn-primary btn-sm">Renovar</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-success">
                  <b>CONTRATOS A VENCER A 60 DÍAS</b>
                </div>
                <div class="card-body" style="height: 200px; overflow-y: scroll;">
                  <table class="table table-bordered table-hover w-100">
                    <thead>
                      <tr class="bg-success">
                        <th class="p-1">#</th>
                        <th class="p-1">Trabajador</th>
                        <th class="p-1">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sesenta_dias as $sesenta)
                      <tr>
                        <td class="p-1">{{ $loop->iteration }}</td>
                        <td class="p-1">{{ $sesenta->Nombres }}<i class="fas fa-arrow-right">{{ $sesenta->FechaDeFinDeContrato }} </i></td>
                        <td class="p-1 text-center"><a href="{{ url('personal/contrato/'.$sesenta->idContrato) }}" class="btn btn-primary btn-sm">Renovar</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>