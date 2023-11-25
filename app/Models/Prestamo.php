<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prestamo
 * 
 * @property int $idPrestamo
 * @property float|null $monto
 * @property int|null $idDatosContables
 * @property Carbon|null $fecha
 * @property string|null $documento
 * 
 * @property Datoscontable|null $datoscontable
 *
 * @package App\Models
 */
class Prestamo extends Model
{
	protected $table = 'prestamo';
	protected $primaryKey = 'idPrestamo';
	public $timestamps = false;

	protected $casts = [
		'monto' => 'float',
		'idDatosContables' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'monto',
		'idDatosContables',
		'fecha',
		'documento'
	];

	public function datoscontable()
	{
		return $this->belongsTo(Datoscontable::class, 'idDatosContables');
	}
}
