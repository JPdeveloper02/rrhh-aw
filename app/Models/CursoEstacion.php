<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CursoEstacion
 * 
 * @property int $id_cursoEstacion
 * @property int $id_cursodehabilitacion
 * @property int $id_estacionTrabajo
 * @property int|null $tipo_curso
 *
 * @package App\Models
 */
class CursoEstacion extends Model
{
	protected $table = 'curso_estacion';
	protected $primaryKey = 'id_cursoEstacion';
	public $timestamps = false;

	protected $casts = [
		'id_cursodehabilitacion' => 'int',
		'id_estacionTrabajo' => 'int',
		'tipo_curso' => 'int'
	];

	protected $fillable = [
		'id_cursodehabilitacion',
		'id_estacionTrabajo',
		'tipo_curso'
	];
}
