<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Etapadeprocedimientodehabilitacion
 * 
 * @property int $idEtapaDeProcedimientoDeHabilitacion
 * @property string|null $NombreEtapaDeProcedimientoDeHabilitacion
 *
 * @package App\Models
 */
class Etapadeprocedimientodehabilitacion extends Model
{
	protected $table = 'etapadeprocedimientodehabilitacion';
	protected $primaryKey = 'idEtapaDeProcedimientoDeHabilitacion';
	public $timestamps = false;

	protected $fillable = [
		'NombreEtapaDeProcedimientoDeHabilitacion'
	];
}
