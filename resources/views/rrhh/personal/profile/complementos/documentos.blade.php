<div class="card">
    <div class="header">

    </div>
    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#contratos" role="tab" aria-controls="pills-home" aria-selected="true">Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#descanso_medico" role="tab" aria-controls="pills-profile" aria-selected="false">Descansos Medicos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#licencias" role="tab" aria-controls="pills-contact" aria-selected="false">Licencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#declaraciones_juradas" role="tab" aria-controls="pills-contact" aria-selected="false">Declaraciones Juradas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#adendas" role="tab" aria-controls="pills-contact" aria-selected="false">Adendas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#alta_sunat" role="tab" aria-controls="pills-contact" aria-selected="false">Alta Sunat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#boleta_sunat" role="tab" aria-controls="pills-contact" aria-selected="false">Boleta Sunat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#vacaciones" role="tab" aria-controls="pills-contact" aria-selected="false">Vacaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#seguros" role="tab" aria-controls="pills-contact" aria-selected="false">Seguros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#otros" role="tab" aria-controls="pills-contact" aria-selected="false">Otros</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="contratos" role="tabpanel" aria-labelledby="pills-home-tab">
                @include('rrhh.personal.profile.tablas_documentos.contratos')
            </div>
            <div class="tab-pane fade" id="descanso_medico" role="tabpanel" aria-labelledby="pills-profile-tab">
                @include('rrhh.personal.profile.tablas_documentos.descanso_medico')
            </div>
            <div class="tab-pane fade" id="licencias" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.licencias')
            </div>
            <div class="tab-pane fade" id="declaraciones_juradas" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.declaraciones_juradas')
            </div>
            <div class="tab-pane fade" id="adendas" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.adendas')
            </div>
            <div class="tab-pane fade" id="alta_sunat" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.alta_sunat')
            </div>
            <div class="tab-pane fade" id="boleta_sunat" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.boleta_sunat')
            </div>
            <div class="tab-pane fade" id="vacaciones" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.vacaciones')
            </div>
            <div class="tab-pane fade" id="seguros" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.seguros')
            </div>
            <div class="tab-pane fade" id="otros" role="tabpanel" aria-labelledby="pills-contact-tab">
                @include('rrhh.personal.profile.tablas_documentos.otros')
            </div>
          </div>
    </div>
</div>