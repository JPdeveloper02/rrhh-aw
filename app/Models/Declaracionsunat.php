<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Declaracionsunat
 * 
 * @property int $idDeclaracionSunat
 * @property string|null $boleta
 * @property float|null $montoPagado
 * @property float|null $montoQuintaCategoria
 * @property Carbon|null $fechaRegistro
 * @property Carbon|null $fecha_deposito
 * @property int|null $idEmpleado
 * @property float|null $reintegro
 * @property string|null $numero_orden_deposito
 * @property float|null $monto_declarado
 *
 * @package App\Models
 */
class Declaracionsunat extends Model
{
	protected $table = 'declaracionsunat';
	protected $primaryKey = 'idDeclaracionSunat';
	public $timestamps = false;

	protected $casts = [
		'montoPagado' => 'float',
		'montoQuintaCategoria' => 'float',
		'fechaRegistro' => 'datetime',
		'fecha_deposito' => 'datetime',
		'idEmpleado' => 'int',
		'reintegro' => 'float',
		'monto_declarado' => 'float'
	];

	protected $fillable = [
		'boleta',
		'montoPagado',
		'montoQuintaCategoria',
		'fechaRegistro',
		'fecha_deposito',
		'idEmpleado',
		'reintegro',
		'numero_orden_deposito',
		'monto_declarado'
	];
}
