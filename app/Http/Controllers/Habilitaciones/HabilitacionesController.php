<?php

namespace App\Http\Controllers\Habilitaciones;

use App\Http\Controllers\Controller;
use App\Models\Cursodehabilitacion;
use App\Models\CursoEmpleado;
use App\Models\CursoEstacion;
use App\Models\Estaciondetrabajo;
use App\Models\Examenmedico;
use App\Models\Persona;
use App\Models\Tipoexamenmedico;
use Illuminate\Http\Request;

class HabilitacionesController extends Controller
{
    public function index(){
        $empleados = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();

        $estaciones = Estaciondetrabajo::all();
        $cursos = Cursodehabilitacion::join('curso_estacion','cursodehabilitacion.idCursoDeHabilitacion','=','curso_estacion.id_cursodehabilitacion')->get();
        
        return view('rrhh.habilitaciones.index',compact('empleados','estaciones','cursos'));
    }

    public function habilitaciones_buscar(Request $request){
        $idEmpleado = $request->input('id_empleado');

        $empleados = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();

        $empleado = Persona::join('empleado','persona.idPersona','=','empleado.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->where('empleado.idEmpleado',$idEmpleado)
        ->first();

        $listado_cursos = CursoEmpleado::join('empleado','curso_empleado.idEmpleado','=','empleado.idEmpleado')
                                ->join('cursodehabilitacion','curso_empleado.idCursoDeHabilitacion','=','cursodehabilitacion.idCursoDeHabilitacion')    
                                ->where('curso_empleado.idEmpleado',$idEmpleado)->get();
        $listado_examenes = Examenmedico::join('tipoexamenmedico','examenmedico.idTipoDeExamenMedico','=','tipoexamenmedico.idTipoExamenMedico')
                                        ->join('empleado','examenmedico.idEmpleado','=','empleado.idEmpleado')  
                                        ->where('examenmedico.idEmpleado',$idEmpleado)->get();

        $estaciones = Estaciondetrabajo::all();
        $cursos = Cursodehabilitacion::join('curso_estacion','cursodehabilitacion.idCursoDeHabilitacion','=','curso_estacion.id_cursodehabilitacion')->get();
        $cursos_empleado = Cursodehabilitacion::join('curso_estacion','cursodehabilitacion.idCursoDeHabilitacion','curso_estacion.id_cursodehabilitacion')
                                    ->where('curso_estacion.id_estacionTrabajo',$empleado->idEstacionDeTrabajo)->get();
        $examenes = Tipoexamenmedico::all();
        if ($empleado !== null) {
            return view('rrhh.habilitaciones.index', compact('empleados', 'empleado', 'estaciones','cursos','cursos_empleado','examenes','listado_cursos','listado_examenes'));
        } else {
            return view('rrhh.habilitaciones.index', compact('empleados','estaciones','cursos'));
        }

    }

    public function obtener_cursos(Request $request)
    {
        $estacion = $request->query('estacion');

        $cursos = Cursodehabilitacion::join('curso_estacion', 'cursodehabilitacion.idCursoDeHabilitacion', 'curso_estacion.id_cursodehabilitacion')
            ->where('curso_estacion.id_estacionTrabajo', $estacion)
            ->get();

        return response()->json($cursos);
    }
    public function cursos(Request $request)
    {
        try {
            $opcion = $request->input('opcion');
            $idEstacion = $request->input('estacion_trabajo');
            $idCurso = $request->input('cursos');
            $nombre = $request->input('nombre_curso');
    
            if ($opcion == 1) {
                $curso = new Cursodehabilitacion;
                $curso->NombreCursoDeHabilitacion = strtoupper($nombre);
                $curso->save();
                $idCurso = $curso->idCursoDeHabilitacion;
    
                $curso_estacion = new CursoEstacion;
                $curso_estacion->id_cursodehabilitacion = $idCurso;
                $curso_estacion->id_estacionTrabajo = $idEstacion;
                $curso_estacion->save();
            } else if ($opcion == 2) {
                $curso_estacion = new CursoEstacion;
                $curso_estacion->id_cursodehabilitacion = $idCurso;
                $curso_estacion->id_estacionTrabajo = $idEstacion;
                $curso_estacion->save();
            }
    
            return redirect()->back()->with('success_cursos', ' Se registró exitosamente.');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->back()->with('error_cursos', ' Ocurrió un error al procesar la solicitud: ' . $e->getMessage());
        }
    }

    public function habilitacion_empleado(Request $request)
    {
        try {
            $request->validate([
                'documento' => 'mimetypes:application/pdf',
            ], [
                'documento' => 'El campo :attribute debe ser un archivo PDF.'
            ]);
    
            $opcion = $request->input('opcion');
            $idEstacion = $request->input('estacion_trabajo');
            $idCurso = $request->input('cursos');
            $fecha_realizacion = $request->input('fecha_realizacion');
            $fecha_vencimiento = $request->input('fecha_vencimiento');
            $idTipoExamen = $request->input('tipo_examen');
            $idEmpleado = $request->input('idEmpleado');
    
            if ($opcion == 1) {
                $curso_empleado = new CursoEmpleado;
                $curso_empleado->idCursoDeHabilitacion = $idCurso;
                $curso_empleado->idEmpleado = $idEmpleado;
                $curso_empleado->fecha_inicio = $fecha_realizacion;
                $curso_empleado->fecha_vencimiento = $fecha_vencimiento;
                if ($request->hasFile('documento')) {
                    $curso_empleado->documento = $request->file('documento')->store('Cursos', 'public');
                }
                $curso_empleado->save();
            } else if ($opcion == 2) {
                $examen = new Examenmedico;
                $examen->idTipoDeExamenMedico = $idTipoExamen;
                $examen->FechaDeInicioVigencia = $fecha_realizacion;
                $examen->FechaDeFinVidencia = $fecha_vencimiento;
                $examen->idEmpleado = $idEmpleado;
                if ($request->hasFile('documento')) {
                    $examen->documento = $request->file('documento')->store('ExamenMedico', 'public');
                }
                $examen->save();
            }
    
            return redirect()->back()->with('success_habilitacion', ' Se registró exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_habilitacion', ' Ocurrió un error al procesar la solicitud: ' . $e->getMessage());
        }
    }
}
