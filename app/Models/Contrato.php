<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrato
 * 
 * @property int $idContrato
 * @property int $idCondicionDeContrato
 * @property int|null $idMotivoDeCese
 * @property int $idEmpleado
 * @property Carbon $FechaDeInicioDeContrato
 * @property Carbon $FechaDeFinDeContrato
 * @property string|null $empresa
 * @property int|null $idEstacionTrabajo
 * @property string|null $DetalleCese
 * @property string|null $Observaciones_contrato
 * @property string|null $contratopdf
 *
 * @package App\Models
 */
class Contrato extends Model
{
	protected $table = 'contrato';
	protected $primaryKey = 'idContrato';
	public $timestamps = false;

	protected $casts = [
		'idCondicionDeContrato' => 'int',
		'idMotivoDeCese' => 'int',
		'idEmpleado' => 'int',
		'FechaDeInicioDeContrato' => 'datetime',
		'FechaDeFinDeContrato' => 'datetime',
		'idEstacionTrabajo' => 'int'
	];

	protected $fillable = [
		'idCondicionDeContrato',
		'idMotivoDeCese',
		'idEmpleado',
		'FechaDeInicioDeContrato',
		'FechaDeFinDeContrato',
		'empresa',
		'idEstacionTrabajo',
		'DetalleCese',
		'Observaciones_contrato',
		'contratopdf'
	];
}
