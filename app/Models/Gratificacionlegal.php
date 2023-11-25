<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gratificacionlegal
 * 
 * @property int $idGratificacion
 * @property float|null $monto
 * @property Carbon|null $fechaRegistro
 * @property string|null $comprobante
 * @property int|null $idEmpleado
 *
 * @package App\Models
 */
class Gratificacionlegal extends Model
{
	protected $table = 'gratificacionlegal';
	protected $primaryKey = 'idGratificacion';
	public $timestamps = false;

	protected $casts = [
		'monto' => 'float',
		'fechaRegistro' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'monto',
		'fechaRegistro',
		'comprobante',
		'idEmpleado'
	];
}
