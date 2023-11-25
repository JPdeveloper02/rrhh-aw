<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cursodehabilitacion
 * 
 * @property int $idCursoDeHabilitacion
 * @property string|null $NombreCursoDeHabilitacion
 * @property string|null $LinkCurso
 *
 * @package App\Models
 */
class Cursodehabilitacion extends Model
{
	protected $table = 'cursodehabilitacion';
	protected $primaryKey = 'idCursoDeHabilitacion';
	public $timestamps = false;

	protected $fillable = [
		'NombreCursoDeHabilitacion',
		'LinkCurso'
	];
}
