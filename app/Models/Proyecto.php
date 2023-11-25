<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 * 
 * @property int $idProyecto
 * @property string $NombreProyecto
 *
 * @package App\Models
 */
class Proyecto extends Model
{
	protected $table = 'proyecto';
	protected $primaryKey = 'idProyecto';
	public $timestamps = false;

	protected $fillable = [
		'NombreProyecto'
	];
}
