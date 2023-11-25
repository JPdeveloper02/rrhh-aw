<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Liquidacionpagada
 * 
 * @property int $idLiquidacionPagada
 * @property float|null $monto
 * @property Carbon|null $fechaRegistro
 * @property int|null $idEmpleado
 * @property string|null $documento
 *
 * @package App\Models
 */
class Liquidacionpagada extends Model
{
	protected $table = 'liquidacionpagada';
	protected $primaryKey = 'idLiquidacionPagada';
	public $timestamps = false;

	protected $casts = [
		'monto' => 'float',
		'fechaRegistro' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'monto',
		'fechaRegistro',
		'idEmpleado',
		'documento'
	];
}
