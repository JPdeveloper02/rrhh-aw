<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Descuentosderecursoshumano
 * 
 * @property int $idDescuentosDeRecursosHumanos
 * @property string $Motivo
 * @property float $Monto
 *
 * @package App\Models
 */
class Descuentosderecursoshumano extends Model
{
	protected $table = 'descuentosderecursoshumanos';
	protected $primaryKey = 'idDescuentosDeRecursosHumanos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idDescuentosDeRecursosHumanos' => 'int',
		'Monto' => 'float'
	];

	protected $fillable = [
		'Motivo',
		'Monto'
	];
}
