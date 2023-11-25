<?php
use App\Models\Tareo;
use Carbon\Carbon;


function tiempoTrabajado($tiempo1, $tiempo2, $tiempo3, $tiempo4){
    
    $sub1 = strtotime($tiempo2) - strtotime($tiempo1);
    $sub2 = strtotime($tiempo4) - strtotime($tiempo3);

    $subtotal = $sub1 - $sub2;

    $total = gmdate('H:i', $subtotal);

    return $total;
}

function calcularDominical($fecha,$contrato){
    
    $fecha1 = Carbon::parse($fecha);
    $fecha2 = Carbon::parse($fecha);

    if($fecha1->format('N') != 1 && $fecha1->format('N') != 7){
        $lunes = $fecha1->previous('Monday');
        $domingo = $fecha2->next('Sunday');
    }else if($fecha1->format('N') == 1){
        $lunes = $fecha1;
        $domingo = $fecha2->next('Sunday');
    }else if($fecha1->format('N') == 7){
        $lunes = $fecha1->previous('Monday');
        $domingo = $fecha2;
    }

    $sabado = $domingo->copy()->subDay();
    $tareo = Tareo::whereBetween('Fecha',[$lunes, $sabado])
    ->where('idContrato', $contrato)
    ->get();

    $totalHoras = 0;
    foreach ($tareo as $value) {

        $horaIngreso = strtotime($value->HoraDeIngreso);
        $horaSalida = strtotime($value->HoraDeSalida);
        $horaInicioAlmuerzo = strtotime($value->HoraDeInicioDeAlmuerzo);
        $horaFinAlmuerzo = strtotime($value->HoraDeFinDeAlmuerzo);

        $tiempoTrabajado = ($horaSalida - $horaIngreso) - ($horaFinAlmuerzo - $horaInicioAlmuerzo);
        $totalHoras += $tiempoTrabajado;
    }

    $totalHorasDecimal = $totalHoras;
    $evaluar = ($totalHorasDecimal/3600);
    
    if($evaluar >= 48){
        $horaSalidaDomingo = '16:00:00';
    }else if($evaluar < 48){
        $horaEntradaDomingo = '08:00:00';
        $horaSalidaDomingo = date('H:i:s',strtotime($horaEntradaDomingo) + ($totalHorasDecimal/6));
    }

    return [
        'horaSalidaDomingo' => $horaSalidaDomingo,
        'fechaDomingo'=> $domingo,
        'evaluar'=>$evaluar
    ];
}

function calcularMontoAdicional($dia_inicio, $idContrato, $idEstacion)
    {
        $fecha_inicio = new DateTime($dia_inicio);
        $dia_semana = $fecha_inicio->format('N'); // Obtener el día de la semana (1: lunes, 7: domingo)

        // Verificar si los días no son lunes ni domingo
        if ($dia_semana > 1 && $dia_semana < 7) { 
            $monto_adicional = 0;

            // Obtener el lunes de la misma semana
            $fecha_lunes = clone $fecha_inicio;
            $fecha_lunes->modify('last Monday');

            // Calcular la diferencia en días entre el lunes y un día antes de $dia_inicio
            $diferencia_dias = $fecha_lunes->diff($fecha_inicio)->days;

            // Verificar si existe tareo para cada día en la semana previa a $dia_inicio
            for ($i = 0; $i < $diferencia_dias; $i++) {
                $fecha_dia = clone $fecha_lunes;
                $fecha_dia->add(new DateInterval("P{$i}D"));

                // Verificar si existe tareo para el día actual
                $existe_tareo = Tareo::where('Fecha', $fecha_dia->format('Y-m-d'))
                    ->whereIn('idCondicionDeTareo', [1, 2, 11, 12, 13, 4, 6, 7, 8, 9])
                    ->where('idContrato', $idContrato)
                    ->where('tareo.idEstacionDeTrabajo', $idEstacion)
                    ->exists();

                if ($existe_tareo) {
                    // Obtener el tareo para el día actual
                    $tareo = Tareo::where('Fecha', $fecha_dia->format('Y-m-d'))
                        ->whereIn('idCondicionDeTareo', [1, 2, 11, 12, 13, 4, 6, 7, 8, 9])
                        ->where('idContrato', $idContrato)
                         ->where('tareo.idEstacionDeTrabajo', $idEstacion)
                        ->first();

                    $hora_ingreso = $tareo->HoraDeIngreso;
                    $hora_inicioalmuerzo = $tareo->HoraDeInicioDeAlmuerzo;
                    $hora_finalmuerzo = $tareo->HoraDeFinDeAlmuerzo;
                    $hora_salida = $tareo->HoraDeSalida;

                    $tiempo_trabajado = strtotime($hora_salida) - strtotime($hora_ingreso);
                    $tiempo_almuerzo = strtotime($hora_finalmuerzo) - strtotime($hora_inicioalmuerzo);
                    $total_horas_trabajadas = ($tiempo_trabajado - $tiempo_almuerzo) / 3600;

                    if ($total_horas_trabajadas > 8) {
                        $horas_extras = $total_horas_trabajadas - 8;
                        $minutos_extras = ($horas_extras - floor($horas_extras)) * 60;

                        $monto_adicional += round(convertirTiempoDecimal(floor($horas_extras), $minutos_extras), 1);
                    }
                }
            }

            return $monto_adicional;
        }

        return 0; // Retornar 0 si es lunes o domingo
    }

    function calcularMontoRestante($dia_fin, $idContrato, $idEstacion)
    {
        $fecha_fin = new DateTime($dia_fin);
        $dia_semana = $fecha_fin->format('N'); // Obtener el día de la semana (1: lunes, 7: domingo)
    
        if ($dia_semana === '6' || $dia_semana === '7') {
            return 0; // Retornar 0 si es sábado o domingo
        } else {
            // Encontrar el lunes de la semana
            $lunes_semana = clone $fecha_fin; // Crear una copia de la fecha de fin
            $lunes_semana->modify('last monday'); // Encontrar el último lunes
            $diferencia_dias = $fecha_fin->diff($lunes_semana)->days; // Calcular la diferencia de días
    
            $monto_restante = 0; // Variable para almacenar el monto adicional
            
            for ($i = 0; $i <= $diferencia_dias; $i++) {
                $fecha_dia = clone $lunes_semana;
                $fecha_dia->add(new DateInterval("P{$i}D"));
    
                // Verificar si existe tareo para el día actual
                $existe_tareo = Tareo::where('Fecha', $fecha_dia->format('Y-m-d'))
                    ->whereIn('idCondicionDeTareo', [1, 2, 11, 12, 13, 4, 6, 7, 8, 9])
                    ->where('idContrato', $idContrato)
                    ->where('tareo.idEstacionDeTrabajo', $idEstacion)
                    ->exists();
    
                if ($existe_tareo) {
                    // Obtener el tareo para el día actual
                    $tareo = Tareo::where('Fecha', $fecha_dia->format('Y-m-d'))
                        ->whereIn('idCondicionDeTareo', [1, 2, 11, 12, 13, 4, 6, 7, 8, 9])
                        ->where('idContrato', $idContrato)
                        ->where('tareo.idEstacionDeTrabajo', $idEstacion)
                        ->first();
    
                    $hora_ingreso = $tareo->HoraDeIngreso;
                    $hora_inicioalmuerzo = $tareo->HoraDeInicioDeAlmuerzo;
                    $hora_finalmuerzo = $tareo->HoraDeFinDeAlmuerzo;
                    $hora_salida = $tareo->HoraDeSalida;
    
                    $tiempo_trabajado = strtotime($hora_salida) - strtotime($hora_ingreso);
                    $tiempo_almuerzo = strtotime($hora_finalmuerzo) - strtotime($hora_inicioalmuerzo);
                    $total_horas_trabajadas = ($tiempo_trabajado - $tiempo_almuerzo) / 3600;
    
                    if ($total_horas_trabajadas > 8) {
                        $horas_extras = $total_horas_trabajadas - 8;
                        $minutos_extras = ($horas_extras - floor($horas_extras)) * 60;
    
                        $monto_restante += round(convertirTiempoDecimal(floor($horas_extras), $minutos_extras), 1);
                    }
                }
            }
    
            // Realizar otras operaciones o llamadas a funciones aquí
            // ...
    
            return $monto_restante; // Retornar el monto adicional calculado
        }
    }
        
    function convertirTiempoDecimal($horas, $minutos) {
        $decimal = $horas + ($minutos / 60);
        return $decimal;
    }

?>