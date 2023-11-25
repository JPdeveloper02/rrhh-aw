<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Descuento
 * 
 * @property int $idDescuentos
 * @property int $idPeriodo
 * @property int $idContrato
 * @property float $ImpuestoDeQuintaCategoria
 * @property float $Tardanzas
 * @property int $Faltas
 * @property float $DescuentoFondoDePension
 * @property int|null $idAdelantoOCredito
 * @property int|null $idCuentaPorRendir
 * @property float|null $DescuentoRecursosHumanos
 *
 * @package App\Models
 */
class Descuento extends Model
{
	protected $table = 'descuentos';
	protected $primaryKey = 'idDescuentos';
	public $timestamps = false;

	protected $casts = [
		'idPeriodo' => 'int',
		'idContrato' => 'int',
		'ImpuestoDeQuintaCategoria' => 'float',
		'Tardanzas' => 'float',
		'Faltas' => 'int',
		'DescuentoFondoDePension' => 'float',
		'idAdelantoOCredito' => 'int',
		'idCuentaPorRendir' => 'int',
		'DescuentoRecursosHumanos' => 'float'
	];

	protected $fillable = [
		'idPeriodo',
		'idContrato',
		'ImpuestoDeQuintaCategoria',
		'Tardanzas',
		'Faltas',
		'DescuentoFondoDePension',
		'idAdelantoOCredito',
		'idCuentaPorRendir',
		'DescuentoRecursosHumanos'
	];
}
