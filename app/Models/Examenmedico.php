<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Examenmedico
 * 
 * @property int $idExamenMedico
 * @property int $idTipoDeExamenMedico
 * @property Carbon|null $FechaDeInicioVigencia
 * @property Carbon|null $FechaDeFinVidencia
 * @property int $idEmpleado
 * @property string|null $documento
 *
 * @package App\Models
 */
class Examenmedico extends Model
{
	protected $table = 'examenmedico';
	protected $primaryKey = 'idExamenMedico';
	public $timestamps = false;

	protected $casts = [
		'idTipoDeExamenMedico' => 'int',
		'FechaDeInicioVigencia' => 'datetime',
		'FechaDeFinVidencia' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'idTipoDeExamenMedico',
		'FechaDeInicioVigencia',
		'FechaDeFinVidencia',
		'idEmpleado',
		'documento'
	];
}
