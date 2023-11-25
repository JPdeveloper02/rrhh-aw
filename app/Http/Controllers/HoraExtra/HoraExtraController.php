<?php

namespace App\Http\Controllers\HoraExtra;

use App\Http\Controllers\Controller;
use App\Models\Horasextra;
use App\Models\Periodo;
use App\Models\Persona;
use App\Models\Tareo;
use Exception;
use Illuminate\Http\Request;

class HoraExtraController extends Controller
{
    public function horaextra_mostrar(Request $request){
        $periodos = Periodo::all();
        $personas = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();
        return view('rrhh.horas_extras.index',compact('periodos','personas'));
    }

    public function buscar_horasextras(Request $request){
        $periodos = Periodo::all();
        $personas = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
                            ->join('cargo','cargo.idCargo','=','empleado.idCargo')
                            ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
                            ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
                            ->where('contrato.idCondicionDeContrato',1)
                            ->get();
        $idPeriodo = $request->input('periodo');
        $periodo = Periodo::find($idPeriodo);
        $nombre_periodo = $periodo->NombrePeriodo;
        $PrimerFecha = $periodo->DiaDeInicioDelPeriodo;
        $SegundaFecha = $periodo->DiaDeFinDelPeriodo;

        $horas_extras = Tareo::join('contrato','tareo.idContrato','=','contrato.idContrato')
                                ->join('horasextras','tareo.idHorasExtras','=','horasextras.idHorasExtras')
                                ->join('empleado','contrato.idEmpleado','=','empleado.idEmpleado')
                                ->join('persona','empleado.idPersona','=','persona.idPersona')
                                ->whereBetween('tareo.Fecha',[$PrimerFecha,$SegundaFecha])->get();
        if ($horas_extras->count() > 0 ) {
            return view('rrhh.horas_extras.index',compact('periodos','personas','horas_extras','nombre_periodo'));
        }else{
            return view('rrhh.horas_extras.index',compact('periodos','personas'));
         }   
    }

    public function eliminar_horaextra (Request $request){
        $idHoraExtra = $request->input('id');
      try{
        
        $tareo = Tareo::where('idHorasExtras',$idHoraExtra)->first();
        $tareo->idHorasExtras = null;
        $tareo->save();

        $hora_extra = Horasextra::find($idHoraExtra);
        $hora_extra->delete();
        return response()->json(['success' => true, 'message' => 'Hora extra eliminada correctamente']);

      }catch (\Exception $e) {
        return response()->json(['error' => false, 'message' => 'Error al eliminar hora extra: ' . $e->getMessage()]);
    }

    }
}
