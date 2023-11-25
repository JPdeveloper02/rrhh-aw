<?php

namespace App\Http\Controllers\Tareos;

use App\Http\Controllers\Controller;
use App\Models\Condiciondetareo;
use App\Models\Contrato;
use App\Models\Datoscontable;
use App\Models\Estaciondetrabajo;
use App\Models\Periodo;
use App\Models\Persona;
use App\Models\Pruebadeltareo;
use App\Models\RegimenLaboral;
use App\Models\Tareo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class TareoController extends Controller
{
    public function index ()
    {
        $estaciones = Estaciondetrabajo::all();
        $personas = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();
        $condiciones = Condiciondetareo::all();
        return view('rrhh.tareos.index',compact('estaciones','personas','condiciones'));
    }
    public function buscarestacion(Request $request)
    {
        $personas = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();
        $condiciones = Condiciondetareo::all();
        $estaciones = Estaciondetrabajo::all();
        $idEstacion = $request->input('idEstacion');
        $nombre_estacion = Estaciondetrabajo::find($idEstacion);
        $empleados = Contrato::join('empleado','contrato.idEmpleado','=','empleado.idEmpleado')
                                ->join('persona','empleado.idPersona','=','persona.idPersona')
                                ->where('contrato.idEstacionTrabajo', $idEstacion)
                                ->where('contrato.idCondicionDeContrato',1)->get();
        $no_empleados = Contrato::join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
                                ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
                                ->whereNotIn('contrato.idEstacionTrabajo', [$idEstacion])
                                ->where('contrato.idCondicionDeContrato', 1)
                                ->get();
                            

        if (count($empleados) > 0) {
            return view('rrhh.tareos.index',compact('estaciones','empleados','nombre_estacion','no_empleados','personas','condiciones','idEstacion'));
        }
        else{
            return view('rrhh.tareos.index',compact('estaciones','personas','condiciones'));
        }

    }
    public function mostrar_diastareados (){
        $periodos = Periodo::all();
        $estaciones = Estaciondetrabajo::all();
        $empleados = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();
        return view('rrhh.tareos.diastareados',compact('periodos','estaciones','empleados'));
    }

    public function buscardiastareados(Request $request)
    {
    $idEstacion = $request->input('estacion');
    $idPeriodo = $request->input('periodo');
   
    $idContrato = $request->input('contrato');
    $opcion = $request->input('opcion');
    $estacion_buscada = Estaciondetrabajo::find($idEstacion);    

    $periodo = Periodo::find($idPeriodo);
    $dia_inicio = $periodo->DiaDeInicioDelPeriodo;
    $dia_fin = $periodo->DiaDeFinDelPeriodo;
    $estaciones = Estaciondetrabajo::all();
    $condicionTareo = Condiciondetareo::all();

    if($opcion== '1'){
            $tareos = Tareo::join('contrato','tareo.idContrato','=','contrato.idContrato')
            ->join('empleado','contrato.idEmpleado','=','empleado.idEmpleado')
            ->join('persona','empleado.idPersona','=','persona.idPersona')
            ->whereBetween('tareo.Fecha', [$periodo->DiaDeInicioDelPeriodo, $periodo->DiaDeFinDelPeriodo])
            ->where('tareo.idEstacionDeTrabajo',$idEstacion)->get();
            
            $diasTareados = Tareo::join('estaciondetrabajo','tareo.idEstacionDeTrabajo','=','estaciondetrabajo.idEstacionDeTrabajo')
            ->whereBetween('Fecha',[$periodo->DiaDeInicioDelPeriodo, $periodo->DiaDeFinDelPeriodo])
            ->where('tareo.idEstacionDeTrabajo',$idEstacion)->get();

            return view('rrhh.tareos.dias_tareados.principal', compact('tareos','periodo','diasTareados','estaciones','condicionTareo','idEstacion','estacion_buscada','dia_inicio','dia_fin'));
        } else if($opcion=='3'){
            $tareos = Tareo::join('contrato', 'tareo.idContrato', '=', 'contrato.idContrato')
            ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
            ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
            ->join('condiciondetareo', 'tareo.idCondicionDeTareo', '=', 'condiciondetareo.idCondicionDeTareo')
            ->join('estaciondetrabajo', 'tareo.idEstacionDeTrabajo', '=', 'estaciondetrabajo.idEstacionDeTrabajo')
            ->where('contrato.idContrato', $idContrato)
            ->whereBetween('tareo.Fecha', [$periodo->DiaDeInicioDelPeriodo, $periodo->DiaDeFinDelPeriodo])
            ->orderBy('tareo.Fecha', 'asc')
            ->get();
            
            $empleado = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
            ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
            ->where('idContrato', $idContrato)
            ->where('contrato.idCondicionDeContrato',1)
            ->first();
            
            return view('rrhh.tareos.dias_tareados.por_trabajador', compact('tareos','periodo','estaciones','condicionTareo','empleado'));
        }else{
            $tareos = Tareo::join('contrato','tareo.idContrato','=','contrato.idContrato')
            ->join('empleado','contrato.idEmpleado','=','empleado.idEmpleado')
            ->join('persona','empleado.idPersona','=','persona.idPersona')
            ->whereBetween('tareo.Fecha', [$periodo->DiaDeInicioDelPeriodo, $periodo->DiaDeFinDelPeriodo])->get();
            
            $diasTareados = Tareo::join('estaciondetrabajo','tareo.idEstacionDeTrabajo','=','estaciondetrabajo.idEstacionDeTrabajo')
            ->whereBetween('Fecha',[$periodo->DiaDeInicioDelPeriodo, $periodo->DiaDeFinDelPeriodo])->get();
            
            return view('rrhh.tareos.dias_tareados.tareo_todos', compact('tareos','periodo','diasTareados','estaciones','condicionTareo','idEstacion'));
        }
   
    }
    
    public function buscarTareo(Request $request){
        $idTareo = $request->input('idtareo');

        $tareo = Tareo::find($idTareo);

        return $tareo;
    }

    public function guardarEditarTareo(Request $request){
        $idTareo = $request->input('tareo');
        $idContrato = $request->input('contrato');
        $condicionTareo = $request->input('condicionTareo');
        $estacion = $request->input('estacion');
        $fecha = $request->input('fecha');
        $horaIngreso = $request->input('horaIngreso');
        $inicioAlmuerzo = $request->input('inicioAlmuerzo');
        $finAlmuerzo = $request->input('finAlmuerzo');
        $salida = $request->input('horaSalida');

        $regimenLaboralNormal = Estaciondetrabajo::where('idRegimenLaboral',1)
                ->pluck('idEstacionDeTrabajo')
                ->toArray();

        if($idTareo){
            //ACTUALIZAR TAREO
            try {
                $tareo = Tareo::find($idTareo);
                $idContrato = $tareo->idContrato;
                $DatoContable = Datoscontable::where('idContrato',$idContrato)->first();

                $tareo->Fecha = $fecha;
                $tareo->HoraDeIngreso = $horaIngreso;
                $tareo->HoraDeInicioDeAlmuerzo = $inicioAlmuerzo;
                $tareo->HoraDeFinDeAlmuerzo = $finAlmuerzo;
                $tareo->HoraDeSalida = $salida;
                $tareo->idEstacionDeTrabajo = $estacion;
                $tareo->idCondicionDeTareo = $condicionTareo;
                $tareo->idDatoContable = $DatoContable->idDatosContables;
                $tareo->save();

                //EVALUAMOS EL REGIMEN LABORAL DE LA ESTACION
                if(in_array($estacion, $regimenLaboralNormal)){
                    $horaDominical = calcularDominical($fecha, $idContrato);
                    $horaEntradaDomingo = '08:00:00';
                    $horaSalidaDomingo = $horaDominical['horaSalidaDomingo'];

                    $tareoDomingo = Tareo::where('Fecha',$horaDominical['fechaDomingo'])->where('idContrato',$idContrato)->first();
                    if(isset($tareoDomingo)){
                        //SI HAY REGISTRO DEL DOMINGO
                        $tareoDomingo->HoraDeIngreso = '08:00:00';
                        $tareoDomingo->HoraDeSalida = $horaDominical['horaSalidaDomingo'];
                        $tareoDomingo->idDatoContable = $DatoContable->idDatosContables;
                        $tareoDomingo->idDatoContable = $DatoContable->idDatosContables;
                        $tareoDomingo->save();
                        
                    }else{
                        //NO HAY REGISTRO DEL DOMINGO
                        $tareo = new Tareo();

                        $tareo->Fecha = $horaDominical['fechaDomingo'];
                        $tareo->idContrato = $idContrato;
                        $tareo->HoraDeIngreso= $horaEntradaDomingo;
                        $tareo->HoraDeInicioDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeFinDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeSalida = $horaSalidaDomingo;
                        $tareo->idEstacionDeTrabajo = $estacion;
                        $tareo->idCondicionDeTareo = 1;
                        $tareo->idDatoContable = $DatoContable->idDatosContables;
                        $tareo->save();
                    }
                }

                return response()->json(['mensaje'=>'Actualizado Exitosamente']);
            } catch (Exception $e) {
                $error = $e->getMessage();
                return response()->json(['error'=>$error],500);
            }
        }
        if($idContrato){
            //REGISTRAR NUEVO TAREO
            try {
                $DatoContable = Datoscontable::where('idContrato',$idContrato)->first();

                $tareo = new Tareo;
                $tareo->idContrato = $idContrato;
                $tareo->Fecha = $fecha;
                $tareo->HoraDeIngreso = $horaIngreso;
                $tareo->HoraDeInicioDeAlmuerzo = $inicioAlmuerzo;
                $tareo->HoraDeFinDeAlmuerzo = $finAlmuerzo;
                $tareo->HoraDeSalida = $salida;
                $tareo->idEstacionDeTrabajo = $estacion;
                $tareo->idCondicionDeTareo = $condicionTareo;
                $tareo->idDatoContable = $DatoContable->idDatosContables;
                $tareo->save();

                 //EVALUAMOS EL REGIMEN LABORAL DE LA ESTACION
                 if(in_array($estacion, $regimenLaboralNormal)){
                    $horaDominical = calcularDominical($fecha, $idContrato);
                    $horaEntradaDomingo = '08:00:00';
                    $horaSalidaDomingo = $horaDominical['horaSalidaDomingo'];

                    $tareoDomingo = Tareo::where('Fecha',$horaDominical['fechaDomingo'])->where('idContrato',$idContrato)->first();
                    if(isset($tareoDomingo)){
                        //SI HAY REGISTRO DEL DOMINGO
                        $tareoDomingo->HoraDeIngreso = '08:00:00';
                        $tareoDomingo->HoraDeSalida = $horaDominical['horaSalidaDomingo'];
                        $tareoDomingo->idDatoContable = $DatoContable->idDatosContables;
                        $tareoDomingo->idDatoContable = $DatoContable->idDatosContables;
                        $tareoDomingo->save();
                        
                    }else{
                        //NO HAY REGISTRO DEL DOMINGO
                        $tareo = new Tareo();

                        $tareo->Fecha = $horaDominical['fechaDomingo'];
                        $tareo->idContrato = $idContrato;
                        $tareo->HoraDeIngreso= $horaEntradaDomingo;
                        $tareo->HoraDeInicioDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeFinDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeSalida = $horaSalidaDomingo;
                        $tareo->idEstacionDeTrabajo = $estacion;
                        $tareo->idCondicionDeTareo = 1;
                        $tareo->idDatoContable = $DatoContable->idDatosContables;
                        $tareo->save();
                    }
                }

                return response()->json(['mensaje'=>'Registrado Exitosamente']);
            } catch (Exception $e) {
                $error = $e->getMessage();
                return response()->json(['error'=>$error],500);
            }
        }        
    }

    public function eliminarTareo(Request $request)
    {
        $idTareo = $request->input('idTareo');
        
        try {
            Tareo::destroy($idTareo);
            return response()->json(['mensaje' => 'Registro borrado exitosamente']);
        } catch (Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }

    public function leyendaTareo($idCondicion){
        if($idCondicion == 1){
            return 'N';
        }else if($idCondicion == 2){
            return 'F';
        }else if($idCondicion == 4){
            return 'DM';
        }else if($idCondicion == 5){
            return 'LS';
        }else if($idCondicion == 6){
            return 'LC';
        }else if($idCondicion == 7){
            return 'DP';
        }else if($idCondicion == 8){
            return 'FT';
        }else if($idCondicion == 9){
            return 'V';
        }elseif($idCondicion == 12){
            return 'HN';
        }elseif ($idCondicion == 14){
            return 'FE';
        }
    }
    public function totalCondicionesDeTareo($idContrato, $idCondicionDeTareo){
        $condicion = 0;
        if($idCondicionDeTareo == 3){
            return  $condicion++;
        }
    }

    public function verTareoEstacion($idEstacion, $fecha)
    {   
        $horas_extras = Tareo::join('contrato','tareo.idContrato','=','contrato.idContrato')
                                ->join('horasextras','tareo.idHorasExtras','=','horasextras.idHorasExtras')
                                ->join('empleado','contrato.idEmpleado','=','empleado.idEmpleado')
                                ->join('persona','empleado.idPersona','=','persona.idPersona')
                                ->whereBetween('tareo.Fecha',['2023-08-16','2023-09-15'])->get();    

        $foto = Pruebadeltareo::where('estacion_id', $idEstacion)
                              ->where('Fecha_prueba', $fecha)
                              ->first();
    
        return view('rrhh.tareos.dias_tareados.prueba_tareo',compact('foto'));
    }

}
