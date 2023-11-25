<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tareo
 * 
 * @property int $idTareo
 * @property int $idContrato
 * @property Carbon $Fecha
 * @property Carbon $HoraDeIngreso
 * @property Carbon $HoraDeInicioDeAlmuerzo
 * @property Carbon $HoraDeFinDeAlmuerzo
 * @property Carbon $HoraDeSalida
 * @property int|null $idCondicionDeTareo
 * @property int $idEstacionDeTrabajo
 * @property int|null $idLicenciaConGoceDeHaber
 * @property int|null $idLicenciaSinGoceDeHaber
 * @property int|null $idDescansoMedico
 * @property int|null $idHorasExtras
 * @property int|null $idVacaciones
 * @property string|null $DetalleTareo
 * @property int $idDatoContable
 *
 * @package App\Models
 */
class Tareo extends Model
{
	protected $table = 'tareo';
	protected $primaryKey = 'idTareo';
	public $timestamps = false;

	protected $casts = [
		'idContrato' => 'int',
		'Fecha' => 'datetime',
		'HoraDeIngreso' => 'datetime',
		'HoraDeInicioDeAlmuerzo' => 'datetime',
		'HoraDeFinDeAlmuerzo' => 'datetime',
		'HoraDeSalida' => 'datetime',
		'idCondicionDeTareo' => 'int',
		'idEstacionDeTrabajo' => 'int',
		'idLicenciaConGoceDeHaber' => 'int',
		'idLicenciaSinGoceDeHaber' => 'int',
		'idDescansoMedico' => 'int',
		'idHorasExtras' => 'int',
		'idVacaciones' => 'int',
		'idDatoContable' => 'int'
	];

	protected $fillable = [
		'idContrato',
		'Fecha',
		'HoraDeIngreso',
		'HoraDeInicioDeAlmuerzo',
		'HoraDeFinDeAlmuerzo',
		'HoraDeSalida',
		'idCondicionDeTareo',
		'idEstacionDeTrabajo',
		'idLicenciaConGoceDeHaber',
		'idLicenciaSinGoceDeHaber',
		'idDescansoMedico',
		'idHorasExtras',
		'idVacaciones',
		'DetalleTareo',
		'idDatoContable'
	];
}
