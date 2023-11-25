<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estadodecurso
 * 
 * @property int $idEstadoDeCurso
 * @property string|null $NombreEstadoDeCurso
 *
 * @package App\Models
 */
class Estadodecurso extends Model
{
	protected $table = 'estadodecurso';
	protected $primaryKey = 'idEstadoDeCurso';
	public $timestamps = false;

	protected $fillable = [
		'NombreEstadoDeCurso'
	];
}
