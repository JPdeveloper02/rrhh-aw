<?php

namespace App\Http\Controllers\Tareos;

use App\Http\Controllers\Controller;
use App\Models\Estaciondetrabajo;
use App\Models\Pruebadeltareo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebasTareoController extends Controller
{
    public function index(){
        $estaciones = Estaciondetrabajo::all();
        return view('rrhh.tareos.fotos_tareo.index',compact('estaciones'));
    }

    public function buscar_fotos_tareos(Request $request)
    {
        $estaciones = Estaciondetrabajo::all();
        $estacionId = $request->input('estacion_id');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        $fechas = [];
        $start = Carbon::parse($fechaInicio);
        $end = Carbon::parse($fechaFin);
    
        while ($start->lte($end)) {
            $fechas[] = $start->toDateString();
            $start->addDay();
        }
    
        $pruebasTareo = Pruebadeltareo::where('estacion_id', $estacionId)->get();
        $estacion = Estaciondetrabajo::find($estacionId);
    
        return view('rrhh.tareos.fotos_tareo.index', compact('fechas', 'pruebasTareo','estacion','estaciones'));
    }

    public function registrar_fotos(Request $request)
    {
        try {
            $request->validate([
                'documento' => 'mimes:png,jpg,jpeg,pdf',
            ], [
                'documento.mimes' => 'El campo :attribute debe ser un archivo PNG, JPG, JPEG o PDF.',
            ]); 
            
            $idEstacion = $request->input('idEstacion');
            $fecha = $request->input('fecha');
    
            $pruebas = new Pruebadeltareo;
            $pruebas->Fecha_prueba = $fecha;
            $pruebas->estacion_id = $idEstacion;
    
            if ($request->hasFile('documento')) {
                $pruebas->img_prueba_tareo = $request->file('documento')->store('PruebasTareo', 'public');
            }
            $pruebas->save();
    
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // Manejo de la excepción
            return response()->json(['success' => false, 'error' => 'Ocurrió un error al registrar.'], 500);
        }
    }

    public function eliminar_fotos(Request $request){
         // Obtén los datos enviados en la solicitud
         $idEstacion = $request->input('idEstacion');
         $fecha = $request->input('fecha');
 
         $prueba_tareo = Pruebadeltareo::where('estacion_id', $idEstacion)
             ->where('Fecha_prueba', $fecha)
             ->delete();
 
         if ($prueba_tareo) {
             return response()->json(['mensaje' => 'Registro eliminado con éxito'], 200);
         } else {
             return response()->json(['mensaje' => 'Error al eliminar el registro'], 500);
         }
    }

}
