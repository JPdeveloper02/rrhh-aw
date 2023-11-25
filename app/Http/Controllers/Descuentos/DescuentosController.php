<?php

namespace App\Http\Controllers\Descuentos;

use App\Http\Controllers\Controller;
use App\Models\Adelanto;
use App\Models\Datoscontable;
use App\Models\Estaciondetrabajo;
use App\Models\Otrosdescuento;
use App\Models\Periodo;
use App\Models\Persona;
use App\Models\Prestamo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DescuentosController extends Controller
{
    public function index(){
        $estaciones = Estaciondetrabajo::all();
        $personas = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();

        $periodos = Periodo::all();
            
        return view('rrhh.descuentos.index',compact('personas','estaciones','periodos'));
    }

    public function buscar_descuentos(Request $request)
    {
        $estaciones = Estaciondetrabajo::all();
        $personas = Persona::join('empleado','empleado.idPersona','=','persona.idPersona')
        ->join('cargo','cargo.idCargo','=','empleado.idCargo')
        ->join('contrato','contrato.idEmpleado','=','empleado.idEmpleado')
        ->join('estaciondetrabajo','estaciondetrabajo.idEstacionDeTrabajo','=','contrato.idEstacionTrabajo')
        ->where('contrato.idCondicionDeContrato',1)
        ->get();

        $periodos = Periodo::all();

        $idPeriodo = $request->input('periodo');

        $periodo = Periodo::find($idPeriodo);
        $PrimerFecha = $periodo->DiaDeInicioDelPeriodo;
        $SegundaFecha = $periodo->DiaDeFinDelPeriodo;

        $adelantos = Adelanto::join('datoscontables', 'adelanto.idDatosContables', '=', 'datoscontables.idDatosContables')
                                ->join('contrato', 'datoscontables.idContrato', '=', 'contrato.idContrato')
                                ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
                                ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
                                ->whereBetween('adelanto.FechaDeDeposito', [$PrimerFecha, $SegundaFecha])
                                ->get();

        $prestamos = Prestamo::join('datoscontables', 'prestamo.idDatosContables', '=', 'datoscontables.idDatosContables')
                                ->join('contrato', 'datoscontables.idContrato', '=', 'contrato.idContrato')
                                ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
                                ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
                                ->whereBetween('prestamo.fecha', [$PrimerFecha, $SegundaFecha])
                                ->get();

        $otros = Otrosdescuento::join('datoscontables', 'otrosdescuentos.idDatosContables', '=', 'datoscontables.idDatosContables')
                                ->join('contrato', 'datoscontables.idContrato', '=', 'contrato.idContrato')
                                ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
                                ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
                                ->whereBetween('otrosdescuentos.fecha', [$PrimerFecha, $SegundaFecha])
                                ->get();

        if ($adelantos->count() > 0 || $prestamos->count() > 0 || $otros->count() > 0) {
            return view('rrhh.descuentos.index',compact('personas','estaciones','periodos','adelantos','prestamos','otros'));
        }else{
            return view('rrhh.descuentos.index',compact('personas','estaciones','periodos'));
        }   
    }

    public function registro_descuento(Request $request)
    {
        try {
            $request->validate([
                'documento' => 'mimes:pdf',
            ], [
                'documento' => 'El campo :attribute debe ser un archivo PDF.'
            ], [
                'documento' => 'Documento',
            ]);
            $idContrato = $request->input('idContrato');
            $tipoDescuento = $request->input('tipo_descuento');
            $fecha = $request->input('fecha');
            $monto = $request->input('monto');
            $cuotas = $request->input('cuotas');
            $motivo = $request->input('motivo');
    
            $datosTabla = json_decode($request->input('datosTabla'), true);
    
            $datosContables = Datoscontable::where('idContrato', $idContrato)->first();
    
            if ($tipoDescuento == 2) {
                foreach ($datosTabla as $fila) {
                    $numero = $fila['numero'];
                    $fechaTabla = $fila['fecha'];
                    $montoTabla = $fila['monto'];
                
                    // Parsear la cadena de fecha
                    $fechaParts = explode('/', $fechaTabla);
                    $dia = (int)$fechaParts[0];
                    $mes = (int)$fechaParts[1];
                    $año = (int)$fechaParts[2];
                    $fechaParsed = sprintf('%04d-%02d-%02d', $año, $mes, $dia);
                
                    $prestamo = new Prestamo;
                    $prestamo->idDatosContables = $datosContables->idDatosContables;
                    $prestamo->fecha = $fechaParsed;
                    $prestamo->monto = $montoTabla;
                    $prestamo->save();
                }
            } else if ($tipoDescuento == 1) {
                $adelanto = new Adelanto;
                $adelanto->idDatosContables = $datosContables->idDatosContables;
                $adelanto->MontoAAdelantar = $monto;
                $adelanto->FechaDeDeposito = $fecha;
                if ($request->hasFile('documento')) {
                    $adelanto->LinkDeSolicitud = $request->file('documento')->store('adelantos', 'public');
                }
                $adelanto->save();
            } else if ($tipoDescuento == 3) {
                $otros = new Otrosdescuento;
                $otros->motivo = $motivo;
                $otros->monto = $monto;
                $otros->fecha = $fecha;
                $otros->idDatosContables = $datosContables->idDatosContables;
                $otros->save();
            }
    
            // Retorno exitoso al JavaScript
            return response()->json(['success' => true, 'message' => 'Descuento registrado correctamente']);
        } catch (\Exception $e) {
            // Retorno de error al JavaScript
            return response()->json(['error' => false, 'message' => 'Error al registrar el descuento: ' . $e->getMessage()]);
        }
    }

    public function eliminar_descuento(Request $request)
    {
        $option = $request->input('option');
        $idDescuento  = $request->input('id');

        try {
            if ($option == 1) { // PARA OTROS DESCUENTOS
                $otro = Otrosdescuento::find($idDescuento);
                $otro->delete();
            } else if ($option == 2) { // PARA PRESTAMOS
                $prestamo = Prestamo::find($idDescuento);
                $prestamo->delete();
            } else if ($option == 3) { // PARA ADELANTOS
                $adelanto = Adelanto::find($idDescuento);
                $adelanto->delete();
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
