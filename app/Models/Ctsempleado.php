<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ctsempleado
 * 
 * @property int $idCts
 * @property float|null $montoPagado
 * @property Carbon|null $fechaRegistro
 * @property int|null $idEmpleado
 *
 * @package App\Models
 */
class Ctsempleado extends Model
{
	protected $table = 'ctsempleado';
	protected $primaryKey = 'idCts';
	public $timestamps = false;

	protected $casts = [
		'montoPagado' => 'float',
		'fechaRegistro' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'montoPagado',
		'fechaRegistro',
		'idEmpleado'
	];
}
