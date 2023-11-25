<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Contrato;
use App\Models\Datoscontable;
use App\Models\Descansomedico;
use App\Models\Descuento;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\Estaciondetrabajo;
use App\Models\Fondodepension;
use App\Models\Licenciacongocedehaber;
use App\Models\Licenciasingocedehaber;
use App\Models\Motivodecese;
use App\Models\Persona;
use App\Models\Tareo;
use App\Models\Tipodesangre;
use App\Models\TipoDocumento;
use DateTime;
use DB;
use Exception;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;
use Storage;

class PersonalController extends Controller
{
    public function verPersonal(){

        $empleados = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();

        $tipo_documentos = TipoDocumento::all();

        $estaciones = Estaciondetrabajo::all();

        return view('rrhh.personal.index', compact('empleados','estaciones','tipo_documentos'));
    }

    public function obtenerDatosPersona(Request $request){

        $idEmpleado = $request->input('idEmpleado');

        $datoPersona = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->where('empleado.idEmpleado',$idEmpleado)
        ->first();

        return $datoPersona;
    }

    public function guardarDocContrato(Request $request){

        try {
            $request->validate([
                'formFile' => 'required|file|mimes:pdf'
            ],
            [
                'required' => 'El campo :attribute es obligatorio.',
                'file' => 'El campo :attribute debe ser un archivo.',
            ],
            [
                'formFile' => 'Contrato PDF'
            ]);

            $idEmpleado = $request->input('idEmpleadoContra');

            if($request->hasFile('formFile')){


                $contrato = Contrato::where('idEmpleado',$idEmpleado)->where('idCondicionDeContrato', 1)->first();
                if($contrato){
                    $contrato->contratopdf = $request->file('formFile')->store('contratos', 'public');
                    $contrato->save();
                }else{
                    return response()->json(['error'=>'No se encontró un contrato válido'], 404);
                }
            }else{
                return response()->json(['error' => 'No se encontró un contrato válido'], 404);
            }

            return response()->json(['mensaje'=>'Guardado Exitoso']);

        } catch (Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }

    }

    public function contrato($idContrato){
        $motivos = Motivodecese::all();

        $persona = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->join('datoscontables','contrato.idContrato','=','datoscontables.idContrato')
        ->where('contrato.idContrato',$idContrato)
        ->first();

        $cargos = Cargo::all();
        $estaciones = Estaciondetrabajo::all();
        return view('rrhh.contratos.index', compact('persona','cargos','motivos','estaciones'));
    }
    public function perfil($idContrato){
        $persona = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->join('datoscontables','contrato.idContrato','=','datoscontables.idContrato')
        ->join('fondodepension','empleado.idFondodepension','=','fondodepension.idFondodepension')
        ->join('tipodesangre','persona.idTipoDeSangre','=','tipodesangre.idTipoDeSangre')
        ->where('contrato.idContrato',$idContrato)
        ->first();
        $tareos = Tareo::where('idContrato',$idContrato)->get();
        $dias_trabajados = Tareo::where('idContrato', $idContrato)
                                ->whereIn('idCondicionDeTareo', [1, 2, 7, 8, 11, 12, 13])
                                ->count();
        $idEmpleado = $persona->idEmpleado;
        $contratos  = Contrato::where('idEmpleado',$idEmpleado)
                                ->orderByDesc('idContrato')->get();
        $tipos_sangre = Tipodesangre::all();
        $num_contratos = $contratos->count();
        $cargos = Cargo::all();
        $fondo_pension = Fondodepension::all();
        $estaciones = Estaciondetrabajo::all();
        $otros_documentos = Documento::where('id_empleado',$persona->idEmpleado)->get();
        
        $licencias_sin= Licenciasingocedehaber::join('tareo', 'licenciasingocedehaber.idLicenciaSinGoceDeHaber', '=', 'tareo.idLicenciaSinGoceDeHaber')
                                ->where('tareo.idContrato', $idContrato)
                                ->select('licenciasingocedehaber.FechaDeInicioSinGoceDeHaber', 'licenciasingocedehaber.FechaDeFinSinGoceDeHaber')
                                ->distinct()
                                ->get();

        $licencias_con= Licenciacongocedehaber::join('tareo', 'licenciacongocedehaber.idLicenciaConGoceDeHaber', '=', 'tareo.idLicenciaConGoceDeHaber')
                                ->where('tareo.idContrato', $idContrato)
                                ->select('licenciacongocedehaber.FechaDeInicioConGoceDeHaber', 'licenciacongocedehaber.FechaDeFinConGoceDeHaber')
                                ->distinct()
                                ->get();

        $descansos_medicos = Descansomedico::join('tareo', 'descansomedico.idDescansoMedico', '=', 'tareo.idDescansoMedico')
                                            ->where('tareo.idContrato', $idContrato)
                                            ->select('descansomedico.FechaDeInicioDescansoMedico', 'descansomedico.FechaDeFinDescansoMedico')
                                            ->distinct()
                                            ->get();

        $adelantos = Descuento::join('adelanto','descuentos.idAdelantoOCredito','=', 'adelanto.idAdelanto')
                            ->where('descuentos.idContrato',$idContrato)->get();                   
        
        return view('rrhh.personal.profile.perfil', compact('persona','contratos','licencias_con','licencias_sin','descansos_medicos','tareos','adelantos','otros_documentos','num_contratos','dias_trabajados','tipos_sangre','cargos','fondo_pension','estaciones'));
    }
    
    //DESCANSO MEDICO
    public function descansoMedico(Request $request){
        
        try {
            $request->validate([
                'documento_descanso' => 'mimes:pdf',
                'feFinDescMedico' => 'required',
                'feDescMedico' => 'required',
                'id_contrato' => 'required',
                'estacionesTrabajo' => 'required'
            ],
            [
                'documento_descanso' => 'El campo :attribute debe ser un archivo PDF.'
                //'feFinDescMedico' => 'El campo :attribute debe ser un archivo.',
                //'feDescMedico' => 'El campo :attribute debe ser un archivo.',
                //'id_contrato' => 'El campo :attribute debe ser un archivo.'
            ],
            [
                'documento_descanso' => 'Documento del Descanso Medico',
                'feFinDescMedico' => 'Fecha Fin del Descanso Medico',
                'feDescMedico' => 'Fecha Inicio del Descanso Medico',
                'id_contrato' => 'Numero de Contrato',
                'estacionesTrabajo' => 'Estacion de Trabajo'
            ]);

            //$idEmpleado = $request->input('idEmpleadoContra');

            if($request->hasFile('documento_descanso')){
                $archivo = $request->file('documento_descanso');
                $path = $archivo->store('public/descansosMedico');

                //OBTENER DATOSCONTABLES por IDCONTRATO
                $datoContable = Datoscontable::where('idContrato',$request->input('id_contrato'))->first();

                $fechaInicio = $request->input('feDescMedico');
                $fechaFin = $request->input('feFinDescMedico');

                $fechaInicio = new DateTime($fechaInicio);
                $fechaFin = new DateTime($fechaFin);

                $fechaActual = clone $fechaInicio;
                
                DB::beginTransaction();
                //GUARDAMOS DESCANSO MEDICO
                $descansoMedico = new Descansomedico();
                $descansoMedico->FechaDeInicioDescansoMedico = $fechaInicio->format('Y-m-d');
                $descansoMedico->FechaDeFinDescansoMedico = $fechaFin->format('Y-m-d');
                $descansoMedico->LinkDocumento = $path;
                $descansoMedico->save();

                while($fechaActual <= $fechaFin){
                    //REGISTRO DE TAREO Y IDDESCANSOMEDICO
                    $tareo = new Tareo();
                    $tareo->idContrato = $request->input('id_contrato');
                    $tareo->Fecha = $fechaActual->format('Y-m-d');
                    $tareo->HoraDeIngreso = '00:00:00';
                    $tareo->HoraDeInicioDeAlmuerzo = '00:00:00';
                    $tareo->HoraDeFinDeAlmuerzo = '00:00:00';
                    $tareo->HoraDeSalida = '00:00:00';
                    $tareo->idCondicionDeTareo = 4;
                    $tareo->idEstacionDeTrabajo = $request->input('estacionesTrabajo');
                    $tareo->idDescansoMedico = $descansoMedico->idDescansoMedico;
                    $tareo->idDatoContable = $datoContable->idDatosContables;
                    $tareo->save();

                    $fechaActual->modify('+1 day');
                }
                DB::commit();             
                
            }else{
                return response()->json(['error' => 'Ingrese el documento del Descanso Medico'], 404);
            }

            return response()->json(['mensaje'=>'Descanso Medico guardado Exitosamente']);

        } catch (Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }

    //LICENCIA CON GOCE
    public function licenciaConGoce(Request $request){
        try {
            $request->validate([
                'documentoConGoce' => 'mimes:pdf',
                'fecha_fin' => 'required',
                'fecha_inicio' => 'required',
                'id_contrato' => 'required',
                'estacionTrab' => 'required'
            ], [
                'documentoConGoce' => 'El campo :attribute debe ser un archivo PDF.'
            ], [
                'documentoConGoce' => 'Documento de la Licencia',
                'fecha_fin' => 'Fecha del Fin de la Licencia',
                'fecha_inicio' => 'Fecha Inicio de la Descanso Medico',
                'id_contrato' => 'Numero de Contrato',
                'estacionTrab' => 'Estacion de Trabajo'
            ]);
        
            if ($request->hasFile('documentoConGoce')) {
                $archivo = $request->file('documentoConGoce');
                $path = $archivo->store('public/LicenciaConGoce');
                
                //OBTENER DATOSCONTABLES por IDCONTRATO
                $datoContable = Datoscontable::where('idContrato',$request->input('id_contrato'))->first();

                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');
        
                $fechaInicio = new DateTime($fechaInicio);
                $fechaFin = new DateTime($fechaFin);
        
                $fechaActual = clone $fechaInicio;
        
                DB::beginTransaction();
        
                try {
                    // GUARDAMOS DESCANSO MEDICO
                    $licenciaConGoce = new Licenciacongocedehaber();
                    $licenciaConGoce->FechaDeInicioConGoceDeHaber = $fechaInicio->format('Y-m-d');
                    $licenciaConGoce->FechaDeFinConGoceDeHaber = $fechaFin->format('Y-m-d');
                    $licenciaConGoce->LinkDelDocumento = $path;
                    $licenciaConGoce->save();
        
                    while ($fechaActual <= $fechaFin) {
                        // REGISTRO DE TAREO Y IDDESCANSOMEDICO
                        $tareo = new Tareo();
                        $tareo->idContrato = $request->input('id_contrato');
                        $tareo->Fecha = $fechaActual->format('Y-m-d');
                        $tareo->HoraDeIngreso = '00:00:00';
                        $tareo->HoraDeInicioDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeFinDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeSalida = '00:00:00';
                        $tareo->idCondicionDeTareo = 6;
                        $tareo->idEstacionDeTrabajo = $request->input('estacionTrab');
                        $tareo->idLicenciaConGoceDeHaber = $licenciaConGoce->idLicenciaConGoceDeHaber;
                        $tareo->idDatoContable = $datoContable->idDatosContables;
                        $tareo->save();
        
                        $fechaActual->modify('+1 day');
                    }
        
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    // Eliminar el archivo guardado en caso de error en la transacción
                    Storage::delete($path);
                    return response()->json(['ERROR'=> $e->getMessage()],500);
                }
            } else {
                return response()->json(['error' => 'Ingrese el documento del Descanso Medico'], 404);
            }
        
            return response()->json(['mensaje' => 'Descanso Medico guardado Exitosamente']);
        } catch (Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }
    
    //LICENCIA SIN GOCE
    public function licenciaSinGoce(Request $request){
        try {
            $request->validate([
                'documento_sin_goce' => 'mimes:pdf',
                'fecha_fin' => 'required',
                'fecha_inicio' => 'required',
                'id_contrato' => 'required',
                'estacionTrabajo' => 'required'
            ], [
                'documento_sin_goce' => 'El campo :attribute debe ser un archivo PDF.'
            ], [
                'documento_sin_goce' => 'Documento de la Licencia',
                'fecha_fin' => 'Fecha del Fin de la Licencia',
                'fecha_inicio' => 'Fecha Inicio de la Descanso Medico',
                'id_contrato' => 'Numero de Contrato',
                'estacionTrabajo' => 'Estacion de Trabajo'
            ]);
        
            if ($request->hasFile('documento_sin_goce')) {
               
                //OBTENER DATOSCONTABLES por IDCONTRATO
                $datoContable = Datoscontable::where('idContrato',$request->input('id_contrato'))->first();

                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');
        
                $fechaInicio = new DateTime($fechaInicio);
                $fechaFin = new DateTime($fechaFin);
        
                $fechaActual = clone $fechaInicio;
        
                DB::beginTransaction();
        
                try {
                    // GUARDAMOS DESCANSO MEDICO
                    $licenciaSinGoce = new Licenciasingocedehaber();
                    $licenciaSinGoce->FechaDeInicioSinGoceDeHaber = $fechaInicio->format('Y-m-d');
                    $licenciaSinGoce->FechaDeFinSinGoceDeHaber = $fechaFin->format('Y-m-d');
                    $licenciaSinGoce->LinkDelDocumento = $request->file('documento_sin_goce')->store('LicenciaSinGoce', 'public');
                    $licenciaSinGoce->save();
        
                    while ($fechaActual <= $fechaFin) {
                        // REGISTRO DE TAREO Y idLICENCIASINGOCE
                        $tareo = new Tareo();
                        $tareo->idContrato = $request->input('id_contrato');
                        $tareo->Fecha = $fechaActual->format('Y-m-d');
                        $tareo->HoraDeIngreso = '00:00:00';
                        $tareo->HoraDeInicioDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeFinDeAlmuerzo = '00:00:00';
                        $tareo->HoraDeSalida = '00:00:00';
                        $tareo->idCondicionDeTareo = 5;
                        $tareo->idEstacionDeTrabajo = $request->input('estacionTrabajo');
                        $tareo->idLicenciaSinGoceDeHaber = $licenciaSinGoce->idLicenciaSinGoceDeHaber;
                        $tareo->idDatoContable = $datoContable->idDatosContables;
                        $tareo->save();
        
                        $fechaActual->modify('+1 day');
                    }
        
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    // Eliminar el archivo guardado en caso de error en la transacción
                    Storage::delete($path);
                    return response()->json(['ERROR'=> $e->getMessage()],500);
                }
            } else {
                return response()->json(['error' => 'Ingrese el documento del Descanso Medico'], 404);
            }
        
            return response()->json(['mensaje' => 'Descanso Medico guardado Exitosamente']);
        } catch (Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }

    public function otrosDocumentos(Request $request)
    {
        try {
            $request->validate([
                'documento' => 'mimes:pdf',
                'fecha_registro' => 'required',
                'id_contrato' => 'required',
            ], [
                'documento' => 'El campo :attribute debe ser un archivo PDF.'
            ], [
                'documento' => 'Documento',
                'fecha_fin' => 'Fecha registro',
                'id_contrato' => 'Numero de Contrato',
            ]);
    
            $idContrato = $request->input('id_contrato');
            $id_tipodocumento = $request->input('tipo_documento');
            $fecha_registro = $request->input('fecha_registro');
            $documento = $request->input('documento');
            $comentario = $request->input('comentario');
    
            $contrato = Contrato::find($idContrato);
            $documentos = new Documento();
            $documentos->id_tipodocumento = $id_tipodocumento;
            $documentos->id_empleado = $contrato->idEmpleado;
            $documentos->fecha_registro = $fecha_registro;
            $documentos->documento = $documento;
            $documentos->comentario = strtoupper($comentario);
    
            if ($request->hasFile('documento')) {
                $documentos->documento = $request->file('documento')->store('otrosDocumentos', 'public');
            }
    
            $documentos->save();
    
            return response()->json(['mensaje' => 'Registro guardado con éxito']);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }

    public function cese_contrato(Request $request)
    {
        try {
            $motivo = $request->input('motivo');
            $fecha_cese = $request->input('fecha_cese');
            $descripcion_cese = $request->input('descripcion_cese');
            $idContrato = $request->input('idContrato');
    
                $antiguo = Contrato::where('idContrato', $idContrato)->first();
                $antiguo->FechaDeFinDeContrato = $fecha_cese;
                if ($antiguo != null) {
                    $antiguo->DetalleCese =  $descripcion_cese;
                }
                $antiguo->idCondicionDeContrato = 2;
                $antiguo->idMotivoDeCese = $motivo;
                $antiguo->save();

    
            return redirect()->back()->with('success_cesecontrato', ' Se registró exitosamente.');
        } catch (\Exception $e) {
            // Manejo de la excepción
            return redirect()->back()->with('error_cesecontrato', ' Ocurrió un error al procesar la solicitud: ' . $e->getMessage());
        }
    }

    public function fin_contrato(Request $request)
    {
        try {
            $motivo = $request->input('motivo');
            $descripcion_cese = $request->input('descripcion_cese');
            $idContrato = $request->input('idContrato');
    
            $antiguo = Contrato::where('idContrato', $idContrato)->first();
            if ($antiguo != null) {
                $antiguo->DetalleCese = $descripcion_cese;
                $antiguo->idCondicionDeContrato = 2;
                $antiguo->idMotivoDeCese = $motivo;
                $antiguo->save();
            }
    
            return redirect()->back()->with('success_fincontrato', 'Se registró exitosamente.');
        } catch (\Exception $e) {
            // Manejo de la excepción
            return redirect()->back()->with('error_fincontrato', 'Ocurrió un error al procesar la solicitud: ' . $e->getMessage());
        }
    }
        public function renovacion (Request $request)
        {
        try {
            $motivo = $request->input('motivo');
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $sueldo = $request->input('sueldo');
            $num_hijos = $request->input('num_hijos');
            $cargo = $request->input('cargo');
            $idContrato = $request->input('idContrato');
    
            $empleado = Contrato::where('idContrato', $idContrato)->first();
            $empleado = Empleado::where('idEmpleado', $empleado->idEmpleado)->first();
            $empleado->idCargo = $cargo;
            $empleado->save();
    
            $antiguo = Contrato::where('idContrato', $idContrato)->first();
            $antiguo->idCondicionDeContrato = 2;
            $antiguo->idMotivoDeCese = $motivo;
            $antiguo->save();
    
            $contrato = new Contrato;
            $contrato->idCondicionDeContrato = 1;
            $contrato->idEmpleado = $empleado->idEmpleado;
            $contrato->FechaDeInicioDeContrato = $fecha_inicio;
            $contrato->FechaDeFinDeContrato = $fecha_fin;
            $contrato->save();
            $idNuevoContrato = $contrato->idContrato;
    
            $datos = new Datoscontable;
            $datos->SueldoBase = $sueldo;
            $datos->NHijos = $num_hijos;
            $datos->idContrato = $idNuevoContrato;
            $datos->save();
    
            $tareo = Tareo::where('idContrato', $idContrato)->get();
            foreach ($tareo as $registro) {
                $registro->idContrato = $idNuevoContrato;
                $registro->save();
            }
            
            return response()->json(['success' => 'Contrato renovado con éxito', 'idNuevoContrato' => $idNuevoContrato]);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }

    //SUBIR CONTRATO POR MEDIO DE PERFIL
    public function perfil_subircontrato(Request $request)
    {
        try {
            $request->validate([
                'documento' => 'mimes:pdf',
            ], [
                'documento.mimes' => 'El campo :attribute debe ser un archivo PDF.'
            ], [
                'documento' => 'Documento',
            ]);

            $idContrato = $request->input('id_contrato');
            $documento = $request->input('documento');


            if ($request->hasFile('documento')) {
                $contrato = Contrato::find($idContrato);
                $contrato->contratopdf = $request->file('documento')->store('contratos', 'public');
                $contrato->save();
            }

            return response()->json(['mensaje' => 'Registro guardado con éxito']);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }

    public function perfil_eliminarcontrato(Request $request)
    {
        try {
            $idContrato = $request->input('id');
    
            $contrato = Contrato::find($idContrato);
            $contrato->contratopdf = NULL;
            $contrato->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function perfil_editarfecha(Request $request)
    {
        try {
            $idContrato = $request->input('id_contrato');
            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');

                $contrato = Contrato::find($idContrato);
                $contrato->FechaDeInicioDeContrato  = $fecha_inicio;
                $contrato->FechaDeFinDeContrato  = $fecha_fin;
                $contrato->save();
            

            return response()->json(['mensaje' => 'Registro guardado con éxito']);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => $error], 500);
        }
    }


}

