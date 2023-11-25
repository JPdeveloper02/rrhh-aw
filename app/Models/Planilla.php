<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Planilla
 * 
 * @property int $idPlanilla
 * @property int $idPeriodo
 * @property int $idDatosContables
 * @property int|null $idDescuentos
 * @property int|null $idBonos
 * @property float $TotalNetoAPagar
 * @property float $PagoEsSalud
 * @property string $empresa
 *
 * @package App\Models
 */
class Planilla extends Model
{
	protected $table = 'planilla';
	protected $primaryKey = 'idPlanilla';
	public $timestamps = false;

	protected $casts = [
		'idPeriodo' => 'int',
		'idDatosContables' => 'int',
		'idDescuentos' => 'int',
		'idBonos' => 'int',
		'TotalNetoAPagar' => 'float',
		'PagoEsSalud' => 'float'
	];

	protected $fillable = [
		'idPeriodo',
		'idDatosContables',
		'idDescuentos',
		'idBonos',
		'TotalNetoAPagar',
		'PagoEsSalud',
		'empresa'
	];
}
