<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bajasunat
 * 
 * @property int $idbajasunat
 * @property Carbon|null $fechaRegistro
 * @property string|null $documento
 * @property int|null $idEmpleado
 *
 * @package App\Models
 */
class Bajasunat extends Model
{
	protected $table = 'bajasunat';
	protected $primaryKey = 'idbajasunat';
	public $timestamps = false;

	protected $casts = [
		'fechaRegistro' => 'datetime',
		'idEmpleado' => 'int'
	];

	protected $fillable = [
		'fechaRegistro',
		'documento',
		'idEmpleado'
	];
}
