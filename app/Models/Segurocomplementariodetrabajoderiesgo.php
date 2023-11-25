<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Segurocomplementariodetrabajoderiesgo
 * 
 * @property int $idSeguroComplementarioDeTrabajoDeRiesgo
 * @property int $idEmpleado
 * @property int $idProyecto
 * @property Carbon|null $FechaDeEmisionDeCetificado
 * @property Carbon|null $FechaDeCaducidadDeCertificado
 *
 * @package App\Models
 */
class Segurocomplementariodetrabajoderiesgo extends Model
{
	protected $table = 'segurocomplementariodetrabajoderiesgo';
	protected $primaryKey = 'idSeguroComplementarioDeTrabajoDeRiesgo';
	public $timestamps = false;

	protected $casts = [
		'idEmpleado' => 'int',
		'idProyecto' => 'int',
		'FechaDeEmisionDeCetificado' => 'datetime',
		'FechaDeCaducidadDeCertificado' => 'datetime'
	];

	protected $fillable = [
		'idEmpleado',
		'idProyecto',
		'FechaDeEmisionDeCetificado',
		'FechaDeCaducidadDeCertificado'
	];
}
