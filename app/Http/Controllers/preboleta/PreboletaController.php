<?php

namespace App\Http\Controllers\preboleta;

use App\Http\Controllers\Controller;
use App\Mail\Notification;
use App\Models\Datoscontable;
use App\Models\Estaciondetrabajo;
use App\Models\Periodo;
use App\Models\Persona;
use App\Models\Tareo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PreboletaController extends Controller
{
    public function index($idPeriodo, $idContrato, $idDatoContable){
        $periodo = Periodo::find($idPeriodo);
        $num_dias = $periodo->CantidadDeDias; 
        $dia_inicio = $periodo->DiaDeInicioDelPeriodo;
        $dia_fin = $periodo->DiaDeFinDelPeriodo;
        $empleado = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
                                ->join('cargo','cargo.idCargo','=','empleado.idCargo')
                                ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
                                ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
                                ->join('fondodepension','empleado.idFondoDePension','=','fondodepension.idFondoDePension')
                                ->where('idContrato',$idContrato)
                                
                                ->first();
        $dato_contable = Datoscontable::find($idDatoContable);
        $estaciones = Estaciondetrabajo::join('tareo', 'estaciondetrabajo.idEstacionDeTrabajo', '=', 'tareo.idEstacionDeTrabajo')
                                        ->whereBetween('tareo.Fecha', [$dia_inicio, $dia_fin])
                                        ->groupBy('estaciondetrabajo.idEstacionDeTrabajo', 'estaciondetrabajo.NombreEstacionDeTrabajo','estaciondetrabajo.estado','estaciondetrabajo.idRegimenLaboral')
                                        ->select('estaciondetrabajo.*')
                                        ->distinct()
                                        ->get();
        $tareos = Tareo::join('contrato', 'tareo.idContrato', '=', 'contrato.idContrato')
                                        ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
                                        ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
                                        ->join('datoscontables', 'contrato.idContrato', '=', 'datoscontables.idContrato')
                                        ->join('estaciondetrabajo', 'contrato.idEstacionTrabajo', '=', 'estaciondetrabajo.idEstacionDeTrabajo')
                                        ->join('fondodepension','empleado.idFondoDePension','=','fondodepension.idFondoDePension')
                                        ->whereBetween('tareo.Fecha', [$dia_inicio, $dia_fin])
                                        ->groupBy('contrato.idContrato', 'tareo.idDatoContable', 'persona.Nombres', 'persona.DNI', 'persona.ApellidoPaterno', 'estaciondetrabajo.NombreEstacionDeTrabajo', 'fondodepension.NombreEntidad', 'datoscontables.SueldoBase')
                                        ->select('contrato.idContrato', 'tareo.idDatoContable', 'persona.Nombres', 'persona.DNI', 'persona.ApellidoPaterno', 'estaciondetrabajo.NombreEstacionDeTrabajo', 'fondodepension.NombreEntidad', DB::raw('MAX(datoscontables.SueldoBase) AS SueldoBase'))
                                        ->get();
        $num_estaciones =$estaciones->count();

        $pdf = Pdf::loadView('rrhh.preboleta.preboleta_pdf',compact('estaciones','tareos','num_estaciones','dia_inicio','dia_fin','num_dias','empleado','idContrato','idDatoContable','dato_contable','periodo'));
        return $pdf->stream();
    }

    public function enviar_preboleta(Request $request)
    {
        $idPeriodo = $request->input('idPeriodo');
        $destinatario = $request->input('destinatario');
        $url = $request->input('url');
        $mensaje = $request->input('mensaje');  

        $periodo = Periodo::find($idPeriodo);
        $nombre_periodo = $periodo->NombrePeriodo;
        $data = [
            "subject"=>"ENVIO DE PREBOLETA",
            "body"=>$mensaje,
            "url"=> $url,
            "nombre_periodo"=> $nombre_periodo
            ];
        try
        {
            $destinatarios = [$destinatario, 'recursoshumanos@awlmaquitec.com'];

            Mail::to($destinatarios)->send(new Notification($data));
            return response()->json(['success' => true, 'message' => 'Envío de email exitoso']);
        }
        catch(Exception $e)
        {
            return response()->json(['success' => false, 'error' => 'Hubo un problema al enviar la preboleta: ' . $e->getMessage()]);
        }
    }
}