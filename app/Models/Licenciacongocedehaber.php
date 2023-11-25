<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Licenciacongocedehaber
 * 
 * @property int $idLicenciaConGoceDeHaber
 * @property Carbon $FechaDeInicioConGoceDeHaber
 * @property Carbon $FechaDeFinConGoceDeHaber
 * @property int|null $DiasHabiles
 * @property string $LinkDelDocumento
 *
 * @package App\Models
 */
class Licenciacongocedehaber extends Model
{
	protected $table = 'licenciacongocedehaber';
	protected $primaryKey = 'idLicenciaConGoceDeHaber';
	public $timestamps = false;

	protected $casts = [
		'FechaDeInicioConGoceDeHaber' => 'datetime',
		'FechaDeFinConGoceDeHaber' => 'datetime',
		'DiasHabiles' => 'int'
	];

	protected $fillable = [
		'FechaDeInicioConGoceDeHaber',
		'FechaDeFinConGoceDeHaber',
		'DiasHabiles',
		'LinkDelDocumento'
	];
}
