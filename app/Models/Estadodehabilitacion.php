<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estadodehabilitacion
 * 
 * @property int $idEstadoDeHabilitacion
 * @property string|null $NombreEstadoDeHabilitacion
 *
 * @package App\Models
 */
class Estadodehabilitacion extends Model
{
	protected $table = 'estadodehabilitacion';
	protected $primaryKey = 'idEstadoDeHabilitacion';
	public $timestamps = false;

	protected $fillable = [
		'NombreEstadoDeHabilitacion'
	];
}
