<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LevantamientoObservacione
 * 
 * @property int $id_levantamiento
 * @property int $idEmpleado
 * @property Carbon $fecha_observacion
 * @property Carbon $fecha_vencimiento
 * @property string $observacion
 * @property string|null $documento
 *
 * @package App\Models
 */
class LevantamientoObservacione extends Model
{
	protected $table = 'levantamiento_observaciones';
	protected $primaryKey = 'id_levantamiento';
	public $timestamps = false;

	protected $casts = [
		'idEmpleado' => 'int',
		'fecha_observacion' => 'datetime',
		'fecha_vencimiento' => 'datetime'
	];

	protected $fillable = [
		'idEmpleado',
		'fecha_observacion',
		'fecha_vencimiento',
		'observacion',
		'documento'
	];
}
