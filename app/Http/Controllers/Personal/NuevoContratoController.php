<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Cargo;
use App\Models\Contrato;
use App\Models\Datoscontable;
use App\Models\Empleado;
use App\Models\Estaciondetrabajo;
use App\Models\Fondodepension;
use App\Models\Persona;
use App\Models\Tipodesangre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;
use PhpOffice\PhpWord\TemplateProcessor;

class NuevoContratoController extends Controller
{
    public function nuevo_contrato (){
        $sangre = Tipodesangre::all();
        $cargos = Cargo::all();
        $fondo_pension = Fondodepension::all();
        $estaciones = Estaciondetrabajo::all();

        return view ('rrhh.nuevo_contrato.index',compact('sangre','cargos','fondo_pension','estaciones'));
    }

    public function nuevo_contrato_registro(Request $request)
    {
        try {
            $persona = new Persona;
            $persona->Nombres = $request->input('nombres');
            $persona->ApellidoPaterno = $request->input('ap_paterno');
            $persona->ApellidoMaterno = $request->input('ap_materno');
            $persona->Email = $request->input('email');
            $persona->DNI = $request->input('dni');
            $persona->Telefono = $request->input('celular');
            $persona->direccion = $request->input('direccion');
            $persona->FechaDeNacimiento = $request->input('fecha_nacimiento');
            $persona->ContactoDeEmergencia = $request->input('nombre_contacto');
            $persona->NumeroDeEmergencia = $request->input('numero_contacto');
            $persona->idTipoDeSangre = $request->input('tipo_sangre');
            $persona->Alergias = $request->input('alergias');
            $persona->save();
            $idPersona = $persona->idPersona;
    
            $empleado = new Empleado;
            $empleado->idPersona = $idPersona;
            $empleado->idCargo = $request->input('cargo');
            $empleado->idFondoDePension = $request->input('fondo');
            $empleado->save();
            $idEmpleado = $empleado->idEmpleado;
    
            $contrato = new Contrato;
            $contrato->idCondicionDeContrato = 1;
            $contrato->idEmpleado = $idEmpleado;
            $contrato->FechaDeInicioDeContrato = $request->input('fecha_inicio');
            $contrato->FechaDeFinDeContrato = $request->input('fecha_fin');
            $contrato->idEstacionTrabajo = $request->input('estacion');
            $contrato->save();
            $idContrato = $contrato->idContrato;
    
            $datos_contables = new Datoscontable;
            $datos_contables->SueldoBase = $request->input('sueldo_base');
            $datos_contables->NHijos = $request->input('num_hijos');
            $datos_contables->idContrato = $idContrato; 
            $datos_contables->pensionAlimenticia = $request->input('pension');
            $datos_contables->save();  
    
            
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Ocurrió un error en el servidor.'], 500);
        }
    }

    public function descargar_nuevo_contrato ($idContrato){
      try{
        $persona = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->join('datoscontables','contrato.idContrato','=','datoscontables.idContrato')
        ->where('contrato.idContrato',$idContrato)
        ->first();

        if($persona->idEstacionDeTrabajo == 2){
            $horario1 = "7:30 AM A 4:45 PM ";
            $horario2 = "7:30 AM a 1:00 PM";
        }else{
            $horario1 = "8:00 AM A 5:15 PM ";
            $horario2 = "8:00 AM a 1:30 PM";
        }

        $fechaactual = Carbon::now();
        $fechaactual->locale('es');
        $fechaFormateada = $fechaactual->isoFormat('DD [DE] MMMM [DE] YYYY');
 
         $plantillaAWL = storage_path('app/public/docs/contratoAWL.docx');
 
  
             $template = new TemplateProcessor($plantillaAWL);
 
             $template->setValue('nombre',strtoupper($persona->Nombres.' '.$persona->ApellidoPaterno.' '.$persona->ApellidoMaterno));
             $template->setValue('dni',$persona->DNI);
             $template->setValue('direccion',$persona->direccion);
             $template->setValue('fechaInicio',$persona->FechaDeInicioDeContrato);
             $template->setValue('cargo',$persona->NombreCargo);
             $template->setValue('fechaFin',$persona->FechaDeFinDeContrato);
             $template->setValue('horario1',$horario1);
             $template->setValue('horario2',$horario2);
             $template->setValue('sueldo',$persona->SueldoBase);
             $formateador = new NumberFormatter('es', NumberFormatter::SPELLOUT);
             $sueldoEscrito = $formateador->format($persona->SueldoBase);
             $template->setValue('sueldoEscrito',$sueldoEscrito);
             $template->setValue('fechaFirma',Strtoupper($fechaFormateada));

             $tempfile = tempnam(sys_get_temp_dir(), 'PHPWord');
             $template->saveAs($tempfile);
             
             $headers = [
                 "Content-Type: application/octet-stream",
             ];
             
             return response()->download($tempfile, $persona->ApellidoPaterno . ' ' . $persona->ApellidoMaterno . ' ' . $persona->Nombres . ' - Contrato.docx', $headers)->deleteFileAfterSend();
 
            } catch (\Exception $e) {
                // Manejo del error
                $errorMessage = $e->getMessage();
                // Puedes imprimir el error en el log, mostrarlo en pantalla o realizar alguna otra acción
                echo "Error al generar el contrato: " . $errorMessage;
            }
        }
}
