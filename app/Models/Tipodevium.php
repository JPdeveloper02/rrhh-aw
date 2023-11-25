<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipodevium
 * 
 * @property int $idTipoDeVia
 * @property string|null $NombreTipoDeVia
 *
 * @package App\Models
 */
class Tipodevium extends Model
{
	protected $table = 'tipodevia';
	protected $primaryKey = 'idTipoDeVia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTipoDeVia' => 'int'
	];

	protected $fillable = [
		'NombreTipoDeVia'
	];
}
