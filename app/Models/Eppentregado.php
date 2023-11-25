<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Eppentregado
 * 
 * @property int $idEppEntregado
 * @property int|null $idEpps
 * @property int|null $idEmpleadoEpp
 * @property int|null $estado
 *
 * @package App\Models
 */
class Eppentregado extends Model
{
	protected $table = 'eppentregado';
	protected $primaryKey = 'idEppEntregado';
	public $timestamps = false;

	protected $casts = [
		'idEpps' => 'int',
		'idEmpleadoEpp' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'idEpps',
		'idEmpleadoEpp',
		'estado'
	];
}
