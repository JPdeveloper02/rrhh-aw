<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Localidad
 * 
 * @property int $idLocalidad
 * @property string|null $Ubigeo
 * @property string|null $Departamento
 * @property string|null $Provincia
 * @property string|null $Distrito
 *
 * @package App\Models
 */
class Localidad extends Model
{
	protected $table = 'localidad';
	protected $primaryKey = 'idLocalidad';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idLocalidad' => 'int'
	];

	protected $fillable = [
		'Ubigeo',
		'Departamento',
		'Provincia',
		'Distrito'
	];
}
