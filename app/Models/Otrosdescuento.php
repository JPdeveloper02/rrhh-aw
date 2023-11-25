<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Otrosdescuento
 * 
 * @property int $idOtrosDescuentos
 * @property string|null $motivo
 * @property float $monto
 * @property Carbon $fecha
 * @property int $idDatosContables
 *
 * @package App\Models
 */
class Otrosdescuento extends Model
{
	protected $table = 'otrosdescuentos';
	protected $primaryKey = 'idOtrosDescuentos';
	public $timestamps = false;

	protected $casts = [
		'monto' => 'float',
		'fecha' => 'datetime',
		'idDatosContables' => 'int'
	];

	protected $fillable = [
		'motivo',
		'monto',
		'fecha',
		'idDatosContables'
	];
}
