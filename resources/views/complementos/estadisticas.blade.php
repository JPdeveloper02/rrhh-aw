<div class="row container-box">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $activos }}</h3>
                <p><b>TRABAJADORES ACTIVOS</b></p>
            </div>
            <div class="icon">
              <i class="fas fa-user-tie text-light"></i>
            </div>
            <a href="#" class="small-box-footer">Ver listado <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
     <!-- ./col -->
     <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 class="text-light">{{ $nuevos_contratos }}</h3>

                <p class="text-light"><b>NUEVOS ESTE MES</b></p>
            </div>
            <div class="icon">
              <i class="far fa-user-circle text-light"></i>
            </div>
            <a href="#" class="small-box-footer text-light">Más información <i class="fas fa-arrow-circle-right text-light"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $estaciones }}</h3>

                <p><b>ESTACIONES DE TRABAJO</b></p>
            </div>
            <div class="icon">
              <i class="fas fa-building text-light"></i>
            </div>
            <a href="#" class="small-box-footer">Ver listado <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
   
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 class="text-light">S/{{ $sueldo_base }}</h3>

                <p class="text-light"><b>TOTAL SUELDO BASE</b></p>
            </div>
            <div class="icon">
                <i class="fas fa-hand-holding-usd text-light"></i>
            </div>
            <a href="#" class="small-box-footer text-light">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>