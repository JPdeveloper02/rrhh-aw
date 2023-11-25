<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Datoscontable;
use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Http\Request;

class EditarDatosController extends Controller
{
    public function datos_personales(Request $request)
    {
        try {
            $idPersona = $request->input("idPersona");
            $idContrato = $request->input('idContrato');
            $nombre = $request->input('Nombres');
            $apellidoPaterno = $request->input('ApellidoPaterno');
            $apellidoMaterno = $request->input('ApellidoMaterno');
            $dni = $request->input('DNI');
            $numeroCelular = $request->input('telefono');
            $direccion = $request->input('direccion');
            $fechaNacimiento = $request->input('FechaDeNacimiento');
            $email = $request->input('Email');
            $tipoSangre = $request->input('tipo_sangre');
            $alergias = $request->input('alergias');
            $contactoEmergencia = $request->input('ContactoDeEmergencia');
            $numeroContacto = $request->input('NumeroDeContacto');
            $numeroHijos = $request->input('NumeroHijos');
            
            $persona = Persona::find($idPersona);
            $persona->Nombres = $nombre;
            $persona->ApellidoPaterno = $apellidoPaterno;
            $persona->ApellidoMaterno = $apellidoMaterno;
            $persona->DNI = $dni;
            $persona->Telefono = $numeroCelular;
            $persona->Email = $email;
            $persona->ContactoDeEmergencia = $contactoEmergencia;
            $persona->NumeroDeEmergencia = $numeroContacto;
            $persona->FechaDeNacimiento = $fechaNacimiento;
            $persona->direccion = $direccion;
            $persona->Alergias = $alergias;
            $persona->idTipoDeSangre = $tipoSangre;
            $persona->save();

            $datos_contables = Datoscontable::where('idContrato', $idContrato)->first();
            $datos_contables->NHijos = $numeroHijos;
            $datos_contables->save();

            return response()->json(['success' => 'Datos personales guardados correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al guardar los datos personales'], 500);
        }
    }


    public function datos_profesionales(Request $request)
    {
        try {
            $idPersona = $request->input('idPersona');
            $idContrato = $request->input('idContrato');
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $idCargo = $request->input('cargo');
            $idfondo = $request->input('fondo_pension');
            $idEstacion = $request->input('estacion_trabajo');
            $sueldo_base = $request->input('sueldo_base');
            $pension_alimenticia = $request->input('pension_alimenticia');
    
            $empleado = Empleado::where('idPersona', $idPersona)->first();
            $empleado->idCargo = $idCargo;
            $empleado->idFondoDePension = $idfondo;
            $empleado->save();
    
            $contrato = Contrato::find($idContrato);
            $contrato->FechaDeInicioDeContrato = $fecha_inicio;
            $contrato->FechaDeFinDeContrato = $fecha_fin;
            $contrato->idEstacionTrabajo = $idEstacion;
            $contrato->save();
    
            $datos_contables = Datoscontable::where('idContrato', $idContrato)->first();
            $datos_contables->SueldoBase = $sueldo_base;
            $datos_contables->pensionAlimenticia = $pension_alimenticia;
            $datos_contables->save();
    
            return response()->json(['success' => 'Datos profesionales guardados correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocurrió un error al guardar los datos profesionales '.$e], 500);
        }
    }
}
