<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Direccion
 * 
 * @property int $idDireccion
 * @property int|null $idTipoDeVia
 * @property string|null $NombreDeVia
 * @property int|null $idTipoDeLocalidad
 * @property string|null $NombreLocalidad
 *
 * @package App\Models
 */
class Direccion extends Model
{
	protected $table = 'direccion';
	protected $primaryKey = 'idDireccion';
	public $timestamps = false;

	protected $casts = [
		'idTipoDeVia' => 'int',
		'idTipoDeLocalidad' => 'int'
	];

	protected $fillable = [
		'idTipoDeVia',
		'NombreDeVia',
		'idTipoDeLocalidad',
		'NombreLocalidad'
	];
}
