@extends('adminlte::page')

@section('title', 'Planilla')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Select2', true)

@section('content_header')
    <link rel="stylesheet" href="{{ asset('css/planilla.css') }}">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0"><b>PLANILLA {{$periodo->NombrePeriodo}}</b></h3>
        <button style="margin: 10px;" class="btn btn-success" onclick="fnExportToExcel('xlsx','Planilla Final <?php echo $periodo->NombrePeriodo ?>')" id="btnExportar">Exportar a Excel <i class="fas fa-file-excel"></i></button>
    </div>
@stop

@section('content')
@include('rrhh.planilla.modales.preboleta_modal')
    <table style="border: 2px solid #000;" id="tablaPlanilla" class="table table-bordered table-hover tablaPlanilla table-responsive">
    <thead>
    <tr>
    <th class="p-1" colspan={{ $num_estaciones + 38 }}></th>
    </tr>
      <tr>
        <th style="background-color: #A4CC9A;" class="th1 p-1 text-center align-middle" colspan="4">
          INFORMACIÓN BÁSICA DE EMPLEADO
        </th>
        <th style="background-color: #C6C7BF;" class="th1 p-1 text-center align-middle" colspan="{{ $num_estaciones+14 }}">
          TAREO
        </th>
        <th colspan="8"></th>
        <th style="background-color: #51AAD9;" class="th1 p-1 text-center align-middle" colspan="10">
          DESCUENTOS
        </th>
        <th class="th1 text-center p-1 align-middle" colspan="1">
          REINTEGROS
        </th>
        <th style="background-color: #51AAD9;" class="th1 text-center p-1 align-middle" colspan="1">
          TOTAL
        </th>
        <th class="th1 p-1 text-center">
          APORTE EsSalud
        </th>
        <th class="th1 p-1 text-center">
          MONTO A REGULARIZAR
        </th>
      </tr>
      <tr>
        <th class="th2 p-1 text-center align-middle" scope="col">
          DNI
        </th>
        <th class="th2 p-1 align-middle" >
          Ubicación
        </th>
        <th class="th2 p-1 align-middle">
          Nombres
        </th>
        <th class="th2 p-1 align-middle">
          Remuneración básica
        </th>
        <th class="th2 p-1 text-center align-middle" colspan="{{ $num_estaciones+2 }}">
          Tareado
        </th>
        <th colspan="2" class="text-center align-middle">
           D. pendientes de pago  
        </th>
        <th class="p-1 text-center align-middle" colspan="2">
          Descanso Médico
        </th>
        <th class="th2 p-1 text-center align-middle" colspan="2">
          DCGH
        </th>
        <th class="th2 p-1 text-center align-middle" colspan="2">
          Vacaciones
        </th>
        <th class="th2 p-1 text-center align-middle" colspan="2">
          Feriados trabajados
        </th>
        <th class="th2 p-1 text-center align-middle" colspan="2">
          Descansos trabajados
        </th>
        <th class="th2 p-1 text-center align-middle">
          Asig. Familiar
        </th>

        <th class="th2 p-1 text-center align-middle" colspan="2">
          Compensación vacacional
        </th>
        <th class="th2 p-1 text-center align-middle" colspan="3">
          Horas extras
        </th>
        <th class="p-1 text-center align-middle">
          Prestamo
        </th>
        <th class="th2 p-1 text-center align-middle">
          Remuneración asegurable
        </th>
        <th class="th2 p-1 text-center align-middle" colspan="2">
          Sistema pensiones
        </th>
        <th class="th2 p-1 text-center align-middle">
          5ta
        </th>
        <th class="th2 p-1 text-center align-middle">
          Devolución de 5ta
        </th>
        <th class="th2 p-1 text-center align-middle">
          Adelantos
        </th>
        <th class="th2 p-1 text-center align-middle">
          Prestamo
        </th>
        <th class="th2 p-1 text-center align-middle">
          Descuentos  
        </th>
        <th class="th2 p-1 text-center align-middle">
           Desc. RRHH  
        </th>
        <th class="th2 p-1 text-center align-middle">
           Pensión alimenticia  
        </th>
        <th class="th2 p-1 text-center align-middle">
           Total Descuentos
        </th>
        <th class="th2 p-1 text-center align-middle">
          Reintegros  
       </th>
        <th class="th2 p-1 text-center align-middle">
           Total Neto  
        </th>
        <th class="th2 p-1 text-center align-middle">
             
        </th>
      </tr>

      <tr class="bg-success">
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        @foreach ($estaciones as $item)
        <th class="th3 p-1 text-center align-middle">{{ $item->NombreEstacionDeTrabajo }}</th>
        @endforeach
        <th class="th3 p-1 text-center align-middle">Total tareado</th>
        <th class="th3 p-1 text-center align-middle">Sueldo bruto</th>
        <th class="th3 p-1 text-center">Días</th>
        <th class="th3 p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center">Días</th>
        <th class="th3 p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center">Días</th>
        <th class="th3 p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center">Días</th>
        <th class="th3 p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center">Días</th>
        <th class="th3 p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center">Días</th>
        <th class="th3 p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center"></th>
        <th class="th3 p-1 text-center">Vacaciones vencidas</th>
        <th class="th3 p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center">HE 25%</th>
        <th class="th3 p-1 text-center">HE 35%</th>
        <th class="th3 p-1 text-center">Horas(S/)</th>
        <th class="p-1 text-center">Monto</th>
        <th class="th3 p-1 text-center"></th>
        <th class="p-1 text-center">Nombre Fondo</th>
        <th class="p-1 text-center">Monto</th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
        <th class="th3"></th>
      </tr>
    </thead>
    <tbody>
      @php
            $totalSueldoBruto = 0;
            $totalAsignacionFamiliar = 0;
            $totalHorasExtras = 0;
            $totalRemuneracionAsegurable = 0;
            $totalFondoPension = 0;
            $totalQuinta = 0;
            $totalAdelantos = 0;
            $totalDescuentos = 0;
            $totalNeto = 0;
            $totalEssalud = 0;
      @endphp
        @foreach ($tareos as $item)
        <tr class="trTable">
          <td>
            {{-- DNI --}}
            {{$item->DNI}}
          </td>
          <td>
            {{-- Estacion --}}
            {{strtoupper($item->NombreEstacionDeTrabajo)}}
          </td>
          <td class="sticky-column" style="background-color: #FDFABE; font-weight: bolder;">
           {{-- Nombres --}}
           <a href="#" data-toggle="modal" data-email="{{ $item->Email }}" data-mensaje="{{ $periodo->Mensaje }}" data-periodo="{{ $periodo->idPeriodo }}" data-target="#modalPreboleta" onclick="setIframeSrc('{{ url('preboleta/'.$periodo->idPeriodo.'/'.$item->idContrato.'/'.$item->idDatosContables)}}')">{{ strtoupper(explode(' ', $item->Nombres)[0]) }} {{ strtoupper($item->ApellidoPaterno) }}</a>
          </td>
          <td class="text-center" style="background-color: #FDFABE; font-weight: bolder;">
            {{-- Sueldo --}}
            @php
                $sueldo_base = null;
            @endphp
            @foreach ($datos_contables as $datos)
                @if ($datos->idDatosContables == $item->idDatosContables)
                    @php
                        $sueldo_base = $datos->SueldoBase;
                    @endphp
                @endif
            @endforeach
            S/{{ $sueldo_base }}
        </td>
        {{-- TAREO POR ESTACION --}}
        @php
        $total_dias_tareados = 0; // Mover la declaración de la variable fuera del bucle
        @endphp
        
          @foreach ($estaciones as $estacion)
            <td> 
              @php
              $tareo_estacion = new \App\Http\Controllers\Planilla\PlanillaController();
              $tareo_estacion_value = $tareo_estacion->TareoPorEstacion($estacion->idEstacionDeTrabajo,$estacion->idRegimenLaboral , $dia_inicio, $dia_fin, $item->idContrato);
                      echo $tareo_estacion_value;
          
              $total_dias_tareados += floatval($tareo_estacion_value); // Convertir a float y sumar directamente
              @endphp
            </td>
          @endforeach  
          @php
          $cantidad_dias_pendientes = $total_dias_tareados > $num_dias ? $total_dias_tareados - $num_dias : 0; // Calcular dias_pendientes
          @endphp
          <td style="background-color: #CEE3F5; font-weight:bolder;">
              {{-- Total días tareados --}}
              {{-- Mostrar dias_pendientes o num_dias --}}
              @if ($total_dias_tareados > $num_dias)
                  {{ round($num_dias,2) }}
              @else
              {{ round($total_dias_tareados,2) }} {{-- Mostrar el resultado --}}
              @endif
          </td>
          <td style="background-color: #CEE3F5; font-weight:bolder;text-align: right;">
             {{-- Sueldo Bruto --}}
             @php
              $sueldo_bruto = round(($sueldo_base/$num_dias)*($total_dias_tareados-$cantidad_dias_pendientes),2);
              echo 'S/'.$sueldo_bruto;   
              $totalSueldoBruto +=$sueldo_bruto;
             @endphp
          </td>
          <td>
             {{-- Dias pendiente de pago - Dias --}}
              @if ($cantidad_dias_pendientes>0)
                {{ round($cantidad_dias_pendientes,2) }}
              @else
                -
              @endif
            
          </td>
          <td>
              {{-- Dias pendiente de pago - Monto --}}
              @if ($cantidad_dias_pendientes>0)
              @php
                $dias_pendientes = round(($sueldo_base/$num_dias)*$cantidad_dias_pendientes,2);
                echo 'S/'.$dias_pendientes;
              @endphp
              @else
              @php
                  $dias_pendientes=0;
              @endphp             
              @endif
          </td>
          <td>
            {{-- Descanso medico - Dias --}}
            @php
                $descanso_medico = new \App\Http\Controllers\Planilla\PlanillaController();
                $descanso_medico_dias = $descanso_medico->DescansoMedico($item->idContrato, $dia_inicio, $dia_fin);
                echo $descanso_medico_dias;
            @endphp
          </td>
          <td>
             {{-- Descanso medico - Monto --}}
             @php
              $descanso_medico = round(($sueldo_base/$num_dias)*$descanso_medico_dias,2);
              echo 'S/'.$descanso_medico;   
             @endphp
          </td>
          <td>
            {{-- Dias con goce - Dias --}}
            @php
                $dias_con_goce = new \App\Http\Controllers\Planilla\PlanillaController();
                $dias_con_goce_dias = $dias_con_goce->DiasConGoce($item->idContrato, $dia_inicio, $dia_fin);
                echo $dias_con_goce_dias;
            @endphp
          </td>
          <td>
             {{-- Dias con goce - Monto --}}
             @php
              $dias_con_goce_haber = round(($sueldo_base/$num_dias)*$dias_con_goce_dias,2);
              echo 'S/'.$dias_con_goce_haber;   
              @endphp
          </td>
          <td>
             {{-- Vacaciones - Dias --}}
             @php
                  $vacaciones_trabajador = new \App\Http\Controllers\Planilla\PlanillaController();
                  $vacaciones_dias = $vacaciones_trabajador->Vacaciones($item->idContrato, $dia_inicio, $dia_fin);
                  echo $vacaciones_dias;
              @endphp
          </td>
          <td>
              {{-- Vacaciones - Monto --}}
              @php
                $vacaciones = round(($sueldo_base/$num_dias)*$vacaciones_dias,2);
                echo 'S/'.$vacaciones;   
              @endphp
          </td>
          <td>
              {{-- Feriados trabajados - Dias --}}
              @php
                $feriados_trabajados = new \App\Http\Controllers\Planilla\PlanillaController();
                $feriados_trabajados_dias = $feriados_trabajados->FeriadosTrabajados($item->idContrato, $dia_inicio, $dia_fin);
                echo $feriados_trabajados_dias;
              @endphp
          </td>
          <td>
             {{-- Feriados trabajdos - Monto --}}
             @php
                $feriados_trabajados = round(($sueldo_base/$num_dias)*$feriados_trabajados_dias,2);
                echo 'S/'.$feriados_trabajados;   
             @endphp
          </td>
          <td>
              {{-- Descansos trabajados - Dias --}}
              @php
                $descansos_trabajados = new \App\Http\Controllers\Planilla\PlanillaController();
                $descansos_trabajados_dias = $descansos_trabajados->DescansosTrabajados($item->idContrato, $dia_inicio, $dia_fin);
                echo $descansos_trabajados_dias;
              @endphp
          </td>
          <td>
              {{-- Descansos trabajados - Monto --}}
              @php
                $descansos_trabajados = round(($sueldo_base/$num_dias)*$descansos_trabajados_dias,2);
                echo 'S/'.$descansos_trabajados;   
              @endphp
            </td>
          <td>
             {{-- Asignacion Familiar --}}
             @php
                $asig_familiar = new \App\Http\Controllers\Planilla\PlanillaController();
                $asignacion_familiar_value = $asig_familiar->AsignacionFamiliar($item->idDatosContables);
                echo 'S/'.$asignacion_familiar_value; 
                $totalAsignacionFamiliar +=$asignacion_familiar_value;
              @endphp
          </td>
          <td class="text-center">
              {{-- Compensacion vacacional - Vacaciones vencidas--}}
              {{ '-' }}
          </td>
          <td class="text-center">
              {{-- Compensacion vacacional - Monto--}}
              {{ '-' }}
          </td>
          <td>
            {{-- Horas extras - HE 25%--}}
            @php
              $horas25 = new \App\Http\Controllers\Planilla\PlanillaController();
              echo $horas25->HorasExtras($item->idContrato, $dia_inicio, $dia_fin,25);
            @endphp
          </td>
          <td>
            {{-- Horas extras - HE 35%--}}
            @php
              $horas25 = new \App\Http\Controllers\Planilla\PlanillaController();
              echo $horas25->HorasExtras($item->idContrato, $dia_inicio, $dia_fin,35);
            @endphp
          </td>
          <td>
            {{-- Horas extras - Total Monto--}}
            @php
              $total_horaextra = new \App\Http\Controllers\Planilla\PlanillaController();
              $horas_extras_value = $total_horaextra->TotalHorasExtras($item->idContrato, $dia_inicio, $dia_fin);
              echo 'S/'.$horas_extras_value;
              $totalHorasExtras += $horas_extras_value;
            @endphp
          </td>
          <td>
            {{-- Prestamo --}}
          </td>
          <td style="background-color: #CEE3F5; font-weight:bolder;text-align: right;">
           {{-- Remuneracion Asegurable --}}
           @php
               $remuneracion_asegurable = round(($sueldo_bruto + $dias_pendientes + $descanso_medico + $dias_con_goce_haber+ $vacaciones + $feriados_trabajados + $descansos_trabajados + $asignacion_familiar_value + $horas_extras_value),2);
               echo 'S/'.$remuneracion_asegurable;
               $totalRemuneracionAsegurable += $remuneracion_asegurable;
           @endphp
          </td>

          {{-- D  E  S  C  U  E  N  T  O  S --}}

          <td>
           {{-- Sistema de Pensión - Nombre --}}
            {{ strtoupper($item->NombreEntidad) }}
          </td>
          <td style="text-align: right;">
            {{-- Sistema de pensión - Monto --}}
            @php
                $porcentaje_fondo = new \App\Http\Controllers\Planilla\PlanillaController();
                $porcentaje_fondo_value = $porcentaje_fondo->PorcentajeFondo($item->idContrato, $remuneracion_asegurable);
                echo 'S/' . $porcentaje_fondo_value;
                $totalFondoPension += $porcentaje_fondo_value;
            @endphp
        </td>
        <td style="text-align: right;">
            {{-- Quinta Categoria --}}
            @php
                $quinta_categoria = new \App\Http\Controllers\Planilla\PlanillaController();
                $quinta_categoria_value = $quinta_categoria->QuintaCategoria($remuneracion_asegurable);
                echo 'S/' . $quinta_categoria_value;
                $totalQuinta += $quinta_categoria_value;
            @endphp
        </td>
        <td>
            {{-- Devolución de 5ta --}}
        </td>
        <td style="text-align: right;">
            {{-- Adelantos --}}
            @php
                $adelantos = new \App\Http\Controllers\Planilla\PlanillaController();
                $adelantos_value = $adelantos->Adelantos($item->idDatosContables, $dia_inicio, $dia_fin);
                echo 'S/' . $adelantos_value;
                $totalAdelantos += $adelantos_value;
            @endphp
        </td>
        <td>
            {{-- Prestamos --}}
            @php
                $prestamos = new \App\Http\Controllers\Planilla\PlanillaController();
                $prestamos_value = $prestamos->Prestamos($item->idDatosContables, $dia_inicio, $dia_fin);
                echo 'S/' . $prestamos_value;
            @endphp
        </td>
        <td style="text-align: right;">
            {{-- Descuentos --}}
            @php
                $otros_descuentos = new \App\Http\Controllers\Planilla\PlanillaController();
                $otros_descuentos_value = $otros_descuentos->OtrosDescuentos($item->idDatosContables, $dia_inicio, $dia_fin);
                echo 'S/' . $otros_descuentos_value;
            @endphp
        </td>
        <td>
            {{-- Descuento RRHH --}}
        </td>
        <td style="text-align: right;">
            {{-- Pensión Alimenticia --}}
            @php
                $pension_alimenticia = new \App\Http\Controllers\Planilla\PlanillaController();
                $pension_alimenticia_value = $pension_alimenticia->PensionAlimenticia($item->idDatosContables, $remuneracion_asegurable);
                echo 'S/' . $pension_alimenticia_value;
            @endphp
        </td>
        <td style="background-color: #CEE3F5; font-weight:bolder;text-align: right;">
            {{-- Total Descuentos --}}
            @php
                $total_descuentos = round($porcentaje_fondo_value + $quinta_categoria_value + $adelantos_value + $prestamos_value + $otros_descuentos_value + $pension_alimenticia_value, 2);
                echo 'S/' . $total_descuentos;
                $totalDescuentos += $total_descuentos;
            @endphp
        </td>
          <td class="text-center">
            {{-- Reintegros--}}
            {{ '-' }}
          </td>
          <td style="background-color: #CEE3F5; font-weight:bolder;" class="text-center">
            {{-- TOTAL NETO --}}
            @php
                $total_neto = $remuneracion_asegurable - $total_descuentos;
                echo 'S/'.$total_neto;
                $totalNeto += $total_neto;
            @endphp
          </td>
          <td>
            {{-- Aporte EsSalud --}}
            @php
                $aporte_essalud = new \App\Http\Controllers\Planilla\PlanillaController();
                $aporte_essalud_value = $aporte_essalud->AporteSeguroEssalud($total_neto);
                echo 'S/' . $aporte_essalud_value;
                $totalEssalud += $aporte_essalud_value;
            @endphp
          </td>
          <td contenteditable="true">

          </td>
         
        </tr>
        @endforeach
        <tr>
		<td colspan="{{ $num_estaciones+5 }}">Total</td>
		<td>
		{{-- Total sueldo bruto --}}
    {{ 'S/'.$totalSueldoBruto }}
		</td>
		<td></td>
		<td colspan="11">--</td>
		<td>
		{{-- Asignación Familiar --}}
    {{ 'S/'.$totalAsignacionFamiliar }}
		</td>
		<td colspan="4"></td>
		<td>
		{{-- Total Horas Extras --}}
    {{ 'S/'.$totalHorasExtras }}
		</td>
		<td colspan="1"></td>
		<td>
		{{-- Total Rem Asegurable --}}
    {{ 'S/'.$totalRemuneracionAsegurable }}
		</td>
		<td colspan="1"></td>
		<td>
		{{-- Total Fondo Pensión --}}
    {{ 'S/'.$totalFondoPension }}
		</td>
		<td>
		{{-- Total Quinta --}}
    {{ 'S/'.$totalQuinta }}
		</td>
		<td></td>
		<td>
		{{-- Total Adelantos --}}
    {{ 'S/'.$totalAdelantos }}
		</td>
		<td colspan="4">
		</td>
		<td> 
			{{-- Total Descuentos --}}
      {{ 'S/'.$totalDescuentos }}
		</td>
    <td></td>
		<td style="background-color: yellow">
		{{-- Total Global --}}
      {{ 'S/'.$totalNeto }}
		</td>
		<td>
		{{-- Total EsSalud --}}
      {{ 'S/'.$totalEssalud }}
		</td>
	</tr>
    </tbody>
  </table>

@stop

@section('js')
<script src="{{ asset('js/preboletas/enviar_preboleta.js') }}"></script>
<script src="{{ asset('js/planilla/descarga_excel.js') }}"></script>
<script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
@stop
