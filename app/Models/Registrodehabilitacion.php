<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Registrodehabilitacion
 * 
 * @property int $idRegistroDeHabilitacion
 * @property int $idEmpleado
 * @property int $idEstadoDeHabiliatacion
 * @property int $idProcedimientoDeHabilitacion
 *
 * @package App\Models
 */
class Registrodehabilitacion extends Model
{
	protected $table = 'registrodehabilitacion';
	protected $primaryKey = 'idRegistroDeHabilitacion';
	public $timestamps = false;

	protected $casts = [
		'idEmpleado' => 'int',
		'idEstadoDeHabiliatacion' => 'int',
		'idProcedimientoDeHabilitacion' => 'int'
	];

	protected $fillable = [
		'idEmpleado',
		'idEstadoDeHabiliatacion',
		'idProcedimientoDeHabilitacion'
	];
}
