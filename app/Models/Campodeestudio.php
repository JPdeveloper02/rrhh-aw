<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Campodeestudio
 * 
 * @property int $idCampoDeEstudio
 * @property string|null $NombreCampoDeEstudio
 *
 * @package App\Models
 */
class Campodeestudio extends Model
{
	protected $table = 'campodeestudio';
	protected $primaryKey = 'idCampoDeEstudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCampoDeEstudio' => 'int'
	];

	protected $fillable = [
		'NombreCampoDeEstudio'
	];
}
