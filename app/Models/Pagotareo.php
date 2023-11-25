<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagotareo
 * 
 * @property int $idPagoTareo
 * @property int $idTareo
 * @property float $CantidadDePago
 * @property int $idPeriodo
 *
 * @package App\Models
 */
class Pagotareo extends Model
{
	protected $table = 'pagotareo';
	protected $primaryKey = 'idPagoTareo';
	public $timestamps = false;

	protected $casts = [
		'idTareo' => 'int',
		'CantidadDePago' => 'float',
		'idPeriodo' => 'int'
	];

	protected $fillable = [
		'idTareo',
		'CantidadDePago',
		'idPeriodo'
	];
}
