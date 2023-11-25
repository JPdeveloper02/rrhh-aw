<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Periodo
 * 
 * @property int $idPeriodo
 * @property string $NombrePeriodo
 * @property Carbon $DiaDeInicioDelPeriodo
 * @property Carbon $DiaDeFinDelPeriodo
 * @property int $CantidadDeDias
 * @property string|null $Mensaje
 *
 * @package App\Models
 */
class Periodo extends Model
{
	protected $table = 'periodo';
	protected $primaryKey = 'idPeriodo';
	public $timestamps = false;

	protected $casts = [
		'DiaDeInicioDelPeriodo' => 'datetime',
		'DiaDeFinDelPeriodo' => 'datetime',
		'CantidadDeDias' => 'int'
	];

	protected $fillable = [
		'NombrePeriodo',
		'DiaDeInicioDelPeriodo',
		'DiaDeFinDelPeriodo',
		'CantidadDeDias',
		'Mensaje'
	];
}
