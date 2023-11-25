<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $idPersona
 * @property string $Nombres
 * @property string $ApellidoPaterno
 * @property string $ApellidoMaterno
 * @property string $DNI
 * @property string $Telefono
 * @property string|null $Email
 * @property string|null $ContactoDeEmergencia
 * @property string|null $NumeroDeEmergencia
 * @property Carbon|null $FechaDeNacimiento
 * @property int|null $idTipoDeSangre
 * @property string|null $Alergias
 * @property string|null $licencia
 * @property string|null $profesion
 * @property string|null $direccion
 * @property string|null $TelefonoFijo
 * @property int|null $idLocalidadDeNacimiento
 * @property int|null $idLocalidadActual
 * @property int|null $idDireccion
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'persona';
	protected $primaryKey = 'idPersona';
	public $timestamps = false;

	protected $casts = [
		'FechaDeNacimiento' => 'datetime',
		'idTipoDeSangre' => 'int',
		'idLocalidadDeNacimiento' => 'int',
		'idLocalidadActual' => 'int',
		'idDireccion' => 'int'
	];

	protected $fillable = [
		'Nombres',
		'ApellidoPaterno',
		'ApellidoMaterno',
		'DNI',
		'Telefono',
		'Email',
		'ContactoDeEmergencia',
		'NumeroDeEmergencia',
		'FechaDeNacimiento',
		'idTipoDeSangre',
		'Alergias',
		'licencia',
		'profesion',
		'direccion',
		'TelefonoFijo',
		'idLocalidadDeNacimiento',
		'idLocalidadActual',
		'idDireccion'
	];
}
