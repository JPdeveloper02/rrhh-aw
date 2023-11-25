<?php

namespace App\Http\Controllers\CumplimientosLegales;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Persona;
use Illuminate\Http\Request;

class CumplimientosLegalesController extends Controller
{
    public function index(){
        $empleados = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();

        $documentos = Documento::all();

        return view('rrhh.cumplimientos_legales.index', compact('empleados','documentos'));
    }
}
