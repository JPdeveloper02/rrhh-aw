<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesoConvocatorium
 * 
 * @property int $id_proceso
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_vencimiento
 * @property int $idCargo
 * @property int $empresa
 * @property int $estado
 *
 * @package App\Models
 */
class ProcesoConvocatorium extends Model
{
	protected $table = 'proceso_convocatoria';
	protected $primaryKey = 'id_proceso';
	public $timestamps = false;

	protected $casts = [
		'fecha_inicio' => 'datetime',
		'fecha_vencimiento' => 'datetime',
		'idCargo' => 'int',
		'empresa' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'fecha_inicio',
		'fecha_vencimiento',
		'idCargo',
		'empresa',
		'estado'
	];
}
