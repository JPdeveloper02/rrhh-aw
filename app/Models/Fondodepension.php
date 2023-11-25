<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Fondodepension
 * 
 * @property int $idFondoDePension
 * @property string $NombreEntidad
 * @property string $TipoDeFondo
 * @property string $TipoDeEmpresa
 * @property float $PorcentajeDeDescuento
 *
 * @package App\Models
 */
class Fondodepension extends Model
{
	protected $table = 'fondodepension';
	protected $primaryKey = 'idFondoDePension';
	public $timestamps = false;

	protected $casts = [
		'PorcentajeDeDescuento' => 'float'
	];

	protected $fillable = [
		'NombreEntidad',
		'TipoDeFondo',
		'TipoDeEmpresa',
		'PorcentajeDeDescuento'
	];
}
