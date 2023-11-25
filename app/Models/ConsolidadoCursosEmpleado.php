<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsolidadoCursosEmpleado
 * 
 * @property int $id_consolidado_control
 * @property int $id_empleado
 * @property int $cursos_por_estacion
 * @property Carbon|null $fecha_vencimiento_curso
 * @property string|null $documento_curso
 *
 * @package App\Models
 */
class ConsolidadoCursosEmpleado extends Model
{
	protected $table = 'consolidado_cursos_empleado';
	protected $primaryKey = 'id_consolidado_control';
	public $timestamps = false;

	protected $casts = [
		'id_empleado' => 'int',
		'cursos_por_estacion' => 'int',
		'fecha_vencimiento_curso' => 'datetime'
	];

	protected $fillable = [
		'id_empleado',
		'cursos_por_estacion',
		'fecha_vencimiento_curso',
		'documento_curso'
	];
}
