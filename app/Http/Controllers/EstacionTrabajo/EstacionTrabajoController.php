<?php

namespace App\Http\Controllers\EstacionTrabajo;

use App\Http\Controllers\Controller;
use App\Models\Estaciondetrabajo;
use App\Models\RegimenLaboral;
use Illuminate\Http\Request;

class EstacionTrabajoController extends Controller
{
    public function index(){

        $regimen = RegimenLaboral::all();
        $estaciones = Estaciondetrabajo::join('regimen_laboral','estaciondetrabajo.idRegimenLaboral','=','regimen_laboral.idRegimenLaboral')->get();
        return view('rrhh.estacion_trabajo.index',compact('estaciones','regimen'));
    }

    public function editar_estado(Request $request)
    {
        try {
            $idEstacion = $request->input('idEstacion');
            $estado = $request->input('estado');
    
            $estacion = Estaciondetrabajo::find($idEstacion);
            $estacion->estado = $estado;
            $estacion->save();
    
            return response()->json(['success' => true, 'message' => 'Los datos se han actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Ha ocurrido un error al procesar la solicitud: ' . $e->getMessage()]);
        }
    }

    public function editar_regimen(Request $request)
    {
        try {
            $idEstacion = $request->input('idEstacion');
            $regimen = $request->input('regimen');
    
            $estacion = Estaciondetrabajo::find($idEstacion);
            $estacion->idRegimenLaboral = $regimen;
            $estacion->save();
    
            return response()->json(['success' => true, 'message' => 'Los datos se han actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Ha ocurrido un error al procesar la solicitud: ' . $e->getMessage()]);
        }
    }

    public function nueva_estacion(Request $request)
    {
        try {
            $nombreEstacion  = $request->input('nombreEstacion');
            $regimen = $request->input('regimen');

            $estacion = new Estaciondetrabajo;
            $estacion->NombreEstacionDeTrabajo = $nombreEstacion;
            $estacion->estado = 1;
            $estacion->idRegimenLaboral = $regimen;
            $estacion->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function eliminar_estacion(Request $request)
    {
        try {
            $idEstacion = $request->input('idEstacion');
    
            $estacion = Estaciondetrabajo::find($idEstacion);
            $estacion->delete();
    
            return response()->json(['success' => true, 'message' => 'Los datos se han eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Ha ocurrido un error al procesar la solicitud: ' . $e->getMessage()]);
        }
    }
}
