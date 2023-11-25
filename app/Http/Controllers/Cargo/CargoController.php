<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index(){
        $cargos = Cargo::all();
        return view('rrhh.cargos.index', compact('cargos'));
    }

    public function eliminar_cargo(Request $request)
    {
        try {
            $idCargo = $request->input('id');
    
            $cargo = Cargo::find($idCargo);
            $cargo->delete();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function editar_cargo(Request $request)
    {
        try {
            $idCargo = $request->input('idCargo');
            $nombreCargo  = $request->input('nombreCargo');
            $cargo = Cargo::find($idCargo);
            $cargo->NombreCargo = $nombreCargo;
            $cargo->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function nuevo_cargo(Request $request)
    {
        try {
            $nombreCargo  = $request->input('nombreCargo');
            $cargo = new Cargo;
            $cargo->NombreCargo = $nombreCargo;
            $cargo->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
