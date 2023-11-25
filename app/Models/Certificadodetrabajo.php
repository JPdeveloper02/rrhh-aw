<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Certificadodetrabajo
 * 
 * @property int $idcertificadodetrabajo
 * @property string|null $documento
 * @property Carbon|null $fechaRegistro
 * @property int|null $idEmpleado
 *
 * @package App\Models
 */
class Certificadodetrabajo extends Model
{
	protected $table = 'certificadodetrabajo';
	protected $primaryKey = 'idcertificadodetrabajo';
	public $timestamps = false;

	protected $casts = [
		'fechaRegistro' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'documento',
		'fechaRegistro',
		'idEmpleado'
	];
}
