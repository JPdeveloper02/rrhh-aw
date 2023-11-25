<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Seguroessaludempleado
 * 
 * @property int $idseguroessaludempleado
 * @property int|null $estado
 * @property Carbon|null $fechaInicio
 * @property Carbon|null $fechaFin
 * @property string|null $constancia
 * @property int|null $idEmpleado
 *
 * @package App\Models
 */
class Seguroessaludempleado extends Model
{
	protected $table = 'seguroessaludempleado';
	protected $primaryKey = 'idseguroessaludempleado';
	public $timestamps = false;

	protected $casts = [
		'estado' => 'int',
		'fechaInicio' => 'datetime',
		'fechaFin' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'estado',
		'fechaInicio',
		'fechaFin',
		'constancia',
		'idEmpleado'
	];
}
