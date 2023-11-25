<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gratificacion
 * 
 * @property int $idGratificacion
 * @property int $MesesConsiderados
 * @property float $SueldoConsiderado
 * @property float|null $TotalAConsiderar
 *
 * @package App\Models
 */
class Gratificacion extends Model
{
	protected $table = 'gratificacion';
	protected $primaryKey = 'idGratificacion';
	public $timestamps = false;

	protected $casts = [
		'MesesConsiderados' => 'int',
		'SueldoConsiderado' => 'float',
		'TotalAConsiderar' => 'float'
	];

	protected $fillable = [
		'MesesConsiderados',
		'SueldoConsiderado',
		'TotalAConsiderar'
	];
}
