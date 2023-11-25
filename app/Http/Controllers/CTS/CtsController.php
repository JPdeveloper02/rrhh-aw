<?php

namespace App\Http\Controllers\CTS;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Planilla\PlanillaController;
use App\Models\Datoscontable;
use App\Models\Estaciondetrabajo;
use App\Models\Tareo;

class CtsController extends Controller
{
    public function index (){
        return view ('rrhh.cts.index');
    }

    public function mostrar_cts(Request $request)
    {
        $mes_cts = $request->input('mes_cts');
        $anio_cts = $request->input('anio_cts');

        $fechaInicial = Carbon::create($anio_cts, $mes_cts, 15); // Crear la fecha inicial con el día 15 del mes seleccionado
        $fechaFinal = $fechaInicial->copy()->subMonths(7); // Restar 7 meses a la fecha inicial para obtener la fecha final (mayo del mismo año)
        $fechaEncabezado = $fechaInicial->copy();
        $fechas = [];

        while ($fechaInicial > $fechaFinal) {
            if ($fechaInicial->format('m') != $mes_cts) {
                $fechas[] = $fechaInicial->toDateString(); // Agregar el mes abreviado en español y el año al array si no es igual al mes inicial
            }
            $fechaInicial->subMonths(1); // Restar un mes a la fecha inicial para obtener el mes anterior
        }
        $fechas = array_reverse($fechas);
        $empleados = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
                            ->join('cargo','cargo.idCargo','=','empleado.idCargo')
                            ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
                            ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
                            ->where('contrato.idCondicionDeContrato', 1)
                            ->get();

        if (count($empleados) > 0) {
            return view('rrhh.cts.index', compact('empleados', 'fechas','fechaEncabezado'));
        } else {
            return view('rrhh.cts.index');
        }
    }

    public function RemuneracionAsegurable($idContrato, $fecha)
    {
        $periodo = Periodo::where('DiaDeInicioDelPeriodo', '<=', $fecha)
            ->where('DiaDeFinDelPeriodo', '>=', $fecha)
            ->first();

        if ($periodo) {
            $estaciones = EstacionDeTrabajo::pluck('idEstacionDeTrabajo');
            $dia_inicio = $periodo->DiaDeInicioDelPeriodo;
            $dia_fin = $periodo->DiaDeFinDelPeriodo;
            $num_dias = $periodo->CantidadDeDias;
    
            $dato_contable = Tareo::where('idContrato',$idContrato)
                                    ->whereBetween('Fecha',[$dia_inicio,$dia_fin])->first();
            $idDatoContable = 0;
            if ($dato_contable) {
                $datos_contables = Datoscontable::find($dato_contable->idDatoContable);
            if ($datos_contables) {
                $sueldo_base = $datos_contables->SueldoBase;
                $idDatoContable = $datos_contables->idDatosContables;
            } else {
                $sueldo_base = 0;
            }
            } else {
                $sueldo_base = 0;
            }

            $planilla = new PlanillaController();
            $totalTareado = 0;
            foreach ($estaciones as $idEstacion) {
                $tareado = $planilla->TareoPorEstacion($idEstacion, $dia_inicio, $dia_fin, $idContrato);
                $totalTareado += $tareado;
            }
            
            $descanso_medico = $planilla->DescansoMedico($idContrato, $dia_inicio, $dia_fin);
            $dias_congoce = $planilla->DiasConGoce($idContrato, $dia_inicio, $dia_fin);
            $vacaciones = $planilla->Vacaciones($idContrato, $dia_inicio, $dia_fin);
            $feriados_trabajados = $planilla->FeriadosTrabajados($idContrato, $dia_inicio, $dia_fin);
            $descansos_trabajados = $planilla->DescansosTrabajados($idContrato, $dia_inicio, $dia_fin);    
            $asignacion_familiar = $planilla->AsignacionFamiliar($idDatoContable);
            $horas_extras = $planilla->TotalHorasExtras($idContrato, $dia_inicio, $dia_fin);

            $parte1 =($sueldo_base/$num_dias)*($totalTareado+$descanso_medico+$vacaciones+$dias_congoce+$feriados_trabajados+$descansos_trabajados);

            $remuneracion_asegurable = round($parte1+$asignacion_familiar+$horas_extras,2);

            return $remuneracion_asegurable;
        } else {
            return 0;
        }
    }
}
