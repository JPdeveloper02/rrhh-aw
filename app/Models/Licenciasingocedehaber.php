<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Licenciasingocedehaber
 * 
 * @property int $idLicenciaSinGoceDeHaber
 * @property Carbon $FechaDeInicioSinGoceDeHaber
 * @property Carbon $FechaDeFinSinGoceDeHaber
 * @property int|null $DiasHabilesAConsiderar
 * @property string $LinkDelDocumento
 *
 * @package App\Models
 */
class Licenciasingocedehaber extends Model
{
	protected $table = 'licenciasingocedehaber';
	protected $primaryKey = 'idLicenciaSinGoceDeHaber';
	public $timestamps = false;

	protected $casts = [
		'FechaDeInicioSinGoceDeHaber' => 'datetime',
		'FechaDeFinSinGoceDeHaber' => 'datetime',
		'DiasHabilesAConsiderar' => 'int'
	];

	protected $fillable = [
		'FechaDeInicioSinGoceDeHaber',
		'FechaDeFinSinGoceDeHaber',
		'DiasHabilesAConsiderar',
		'LinkDelDocumento'
	];
}
