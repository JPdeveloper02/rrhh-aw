<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vacacione
 * 
 * @property int $idVacaciones
 * @property Carbon $FechaDeInicioVacaciones
 * @property Carbon $FechaDeFinVacaciones
 * @property string $LinkDeDocumento
 * @property int|null $DiasAConsiderar
 * @property float|null $indemnizacionDeVacaciones
 * @property int|null $idEmpleado
 *
 * @package App\Models
 */
class Vacacione extends Model
{
	protected $table = 'vacaciones';
	protected $primaryKey = 'idVacaciones';
	public $timestamps = false;

	protected $casts = [
		'FechaDeInicioVacaciones' => 'datetime',
		'FechaDeFinVacaciones' => 'datetime',
		'DiasAConsiderar' => 'int',
		'indemnizacionDeVacaciones' => 'float',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'FechaDeInicioVacaciones',
		'FechaDeFinVacaciones',
		'LinkDeDocumento',
		'DiasAConsiderar',
		'indemnizacionDeVacaciones',
		'idEmpleado'
	];
}
