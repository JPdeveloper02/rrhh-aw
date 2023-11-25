<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Descansomedico
 * 
 * @property int $idDescansoMedico
 * @property Carbon $FechaDeInicioDescansoMedico
 * @property Carbon $FechaDeFinDescansoMedico
 * @property string|null $LinkDocumento
 *
 * @package App\Models
 */
class Descansomedico extends Model
{
	protected $table = 'descansomedico';
	protected $primaryKey = 'idDescansoMedico';
	public $timestamps = false;

	protected $casts = [
		'FechaDeInicioDescansoMedico' => 'datetime',
		'FechaDeFinDescansoMedico' => 'datetime'
	];

	protected $fillable = [
		'FechaDeInicioDescansoMedico',
		'FechaDeFinDescansoMedico',
		'LinkDocumento'
	];
}
