<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Liquidacion
 * 
 * @property int $idLiquidacion
 * @property int|null $idContrato
 * @property Carbon|null $FechaDeInicio
 * @property Carbon|null $FechaDeFIn
 * @property float|null $MontoEstimado
 * @property float|null $BeneficiosNoPagados
 *
 * @package App\Models
 */
class Liquidacion extends Model
{
	protected $table = 'liquidacion';
	protected $primaryKey = 'idLiquidacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idLiquidacion' => 'int',
		'idContrato' => 'int',
		'FechaDeInicio' => 'datetime',
		'FechaDeFIn' => 'datetime',
		'MontoEstimado' => 'float',
		'BeneficiosNoPagados' => 'float'
	];

	protected $fillable = [
		'idContrato',
		'FechaDeInicio',
		'FechaDeFIn',
		'MontoEstimado',
		'BeneficiosNoPagados'
	];
}
