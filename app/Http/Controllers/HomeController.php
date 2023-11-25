<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Estaciondetrabajo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fechaActual = Carbon::now();
        // Obtener el mes y el año actual
        $mesActual = $fechaActual->month;
        $anioActual = $fechaActual->year;

        $vencidos = DB::table('contrato')
            ->select('contrato.idContrato', DB::raw("CONCAT(UPPER(SUBSTRING_INDEX(persona.Nombres, ' ', 1)), ' ', UPPER(persona.ApellidoPaterno)) AS Nombres"), DB::raw("DATE_FORMAT(contrato.FechaDeFinDeContrato, '%d/%m/%Y') AS FechaDeFinDeContrato"))
            ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
            ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
            ->where('contrato.FechaDeFinDeContrato', '<=', DB::raw('CURRENT_DATE()'))
            ->where('contrato.idCondicionDeContrato', 1)
            ->get();


        $treinta_dias = DB::table('contrato')
            ->select('contrato.idContrato', DB::raw("CONCAT(UPPER(SUBSTRING_INDEX(persona.Nombres, ' ', 1)), ' ', UPPER(persona.ApellidoPaterno)) AS Nombres"), DB::raw("DATE_FORMAT(contrato.FechaDeFinDeContrato, '%d/%m/%Y') AS FechaDeFinDeContrato"))
            ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
            ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
            ->whereDate('contrato.FechaDeFinDeContrato', '<=', DB::raw('CURDATE() + INTERVAL 30 DAY'))
            ->whereDate('contrato.FechaDeFinDeContrato', '>=', DB::raw('CURDATE()'))
            ->where('contrato.idCondicionDeContrato', 1)
            ->get();

        $sesenta_dias = DB::table('contrato')
            ->select('contrato.idContrato',DB::raw("CONCAT(UPPER(SUBSTRING_INDEX(persona.Nombres, ' ', 1)), ' ', UPPER(persona.ApellidoPaterno)) AS Nombres"), DB::raw("DATE_FORMAT(contrato.FechaDeFinDeContrato, '%d/%m/%Y') AS FechaDeFinDeContrato"))
            ->join('empleado', 'contrato.idEmpleado', '=', 'empleado.idEmpleado')
            ->join('persona', 'empleado.idPersona', '=', 'persona.idPersona')
            ->whereDate('contrato.FechaDeFinDeContrato', '>', DB::raw('CURDATE() + INTERVAL 30 DAY'))
            ->whereDate('contrato.FechaDeFinDeContrato', '<=', DB::raw('CURDATE() + INTERVAL 60 DAY'))
            ->where('contrato.idCondicionDeContrato', 1)
            ->get();

        $nuevos_contratos = Contrato::join('datoscontables', 'contrato.idContrato', '=', 'datoscontables.idContrato')
            ->where('idCondicionDeContrato', 1)
            ->whereMonth('FechaDeInicioDeContrato', $mesActual)
            ->whereYear('FechaDeInicioDeContrato', $anioActual)
            ->count();

        $contratos = Contrato::join('datoscontables','contrato.idContrato','=','datoscontables.idContrato')
                                ->where('idCondicionDeContrato',1)->get();
        $estaciones = Estaciondetrabajo::count();

        $activos = $contratos->count();
        $sueldo_base=0;
        foreach ($contratos as $item){
            $sueldo_base += $item->SueldoBase;
        }

        return view('home',compact('vencidos','treinta_dias','sesenta_dias','activos','estaciones','sueldo_base','nuevos_contratos'));

    }
}
