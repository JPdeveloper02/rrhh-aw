<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Seguroempleado
 * 
 * @property int $idSeguroSmpleado
 * @property int|null $idTipoSeguro
 * @property Carbon|null $fecha
 * @property Carbon|null $fecha_vencimiento
 * @property string|null $documento
 * @property int|null $idEmpleado
 *
 * @package App\Models
 */
class Seguroempleado extends Model
{
	protected $table = 'seguroempleado';
	protected $primaryKey = 'idSeguroSmpleado';
	public $timestamps = false;

	protected $casts = [
		'idTipoSeguro' => 'int',
		'fecha' => 'datetime',
		'fecha_vencimiento' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'idTipoSeguro',
		'fecha',
		'fecha_vencimiento',
		'documento',
		'idEmpleado'
	];
}
