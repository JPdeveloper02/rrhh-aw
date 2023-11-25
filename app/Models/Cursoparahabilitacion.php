<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cursoparahabilitacion
 * 
 * @property int $idCursoParaHabilitacion
 * @property int $idProcedimientoDeHabilitacion
 * @property int $idCursoDeHabilitacion
 * @property Carbon $FechaDeInicioDeCertificacion
 * @property Carbon $FechaDeFinDeCertificacion
 * @property int $idEstadoDeCurso
 *
 * @package App\Models
 */
class Cursoparahabilitacion extends Model
{
	protected $table = 'cursoparahabilitacion';
	protected $primaryKey = 'idCursoParaHabilitacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCursoParaHabilitacion' => 'int',
		'idProcedimientoDeHabilitacion' => 'int',
		'idCursoDeHabilitacion' => 'int',
		'FechaDeInicioDeCertificacion' => 'datetime',
		'FechaDeFinDeCertificacion' => 'datetime',
		'idEstadoDeCurso' => 'int'
	];

	protected $fillable = [
		'idProcedimientoDeHabilitacion',
		'idCursoDeHabilitacion',
		'FechaDeInicioDeCertificacion',
		'FechaDeFinDeCertificacion',
		'idEstadoDeCurso'
	];
}
