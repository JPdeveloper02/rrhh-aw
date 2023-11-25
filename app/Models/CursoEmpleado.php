<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CursoEmpleado
 * 
 * @property int $id_curso_empleado
 * @property int|null $idCursoDeHabilitacion
 * @property int|null $idEmpleado
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_vencimiento
 * @property string|null $documento
 * 
 * @property Empleado|null $empleado
 * @property Cursodehabilitacion $cursodehabilitacion
 *
 * @package App\Models
 */
class CursoEmpleado extends Model
{
	protected $table = 'curso_empleado';
	protected $primaryKey = 'id_curso_empleado';
	public $timestamps = false;

	protected $casts = [
		'idCursoDeHabilitacion' => 'int',
		'idEmpleado' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_vencimiento' => 'datetime'
	];

	protected $fillable = [
		'idCursoDeHabilitacion',
		'idEmpleado',
		'fecha_inicio',
		'fecha_vencimiento',
		'documento'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'idEmpleado');
	}

	public function cursodehabilitacion()
	{
		return $this->belongsTo(Cursodehabilitacion::class, 'id_curso_empleado');
	}
}
