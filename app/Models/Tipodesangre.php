<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipodesangre
 * 
 * @property int $idTipoDeSangre
 * @property string $NombreTipoDeSangre
 *
 * @package App\Models
 */
class Tipodesangre extends Model
{
	protected $table = 'tipodesangre';
	protected $primaryKey = 'idTipoDeSangre';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTipoDeSangre' => 'int'
	];

	protected $fillable = [
		'NombreTipoDeSangre'
	];
}
