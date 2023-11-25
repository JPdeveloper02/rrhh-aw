<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Asignaciondepersonal
 * 
 * @property int $idAsignacionDePersonal
 * @property Carbon|null $FechaDeInicioDeAsignacion
 * @property Carbon|null $FechaDeFinDeAsignacion
 * @property int|null $idRegistroDePersonal
 *
 * @package App\Models
 */
class Asignaciondepersonal extends Model
{
	protected $table = 'asignaciondepersonal';
	protected $primaryKey = 'idAsignacionDePersonal';
	public $timestamps = false;

	protected $casts = [
		'FechaDeInicioDeAsignacion' => 'datetime',
		'FechaDeFinDeAsignacion' => 'datetime',
		'idRegistroDePersonal' => 'int'
	];

	protected $fillable = [
		'FechaDeInicioDeAsignacion',
		'FechaDeFinDeAsignacion',
		'idRegistroDePersonal'
	];
}
