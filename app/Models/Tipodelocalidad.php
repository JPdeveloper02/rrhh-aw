<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipodelocalidad
 * 
 * @property int $idTipoDeLocalidad
 * @property string|null $NombreTipoDeLocalidad
 *
 * @package App\Models
 */
class Tipodelocalidad extends Model
{
	protected $table = 'tipodelocalidad';
	protected $primaryKey = 'idTipoDeLocalidad';
	public $timestamps = false;

	protected $fillable = [
		'NombreTipoDeLocalidad'
	];
}
