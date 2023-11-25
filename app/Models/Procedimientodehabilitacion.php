<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Procedimientodehabilitacion
 * 
 * @property int $idProcedimientoDeHabilitacion
 * @property int|null $idProyecto
 * @property string|null $Nombre
 * @property int|null $idEtapaDeProcemientoDeHabilitacion
 *
 * @package App\Models
 */
class Procedimientodehabilitacion extends Model
{
	protected $table = 'procedimientodehabilitacion';
	protected $primaryKey = 'idProcedimientoDeHabilitacion';
	public $timestamps = false;

	protected $casts = [
		'idProyecto' => 'int',
		'idEtapaDeProcemientoDeHabilitacion' => 'int'
	];

	protected $fillable = [
		'idProyecto',
		'Nombre',
		'idEtapaDeProcemientoDeHabilitacion'
	];
}
