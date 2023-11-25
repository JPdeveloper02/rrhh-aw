<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pruebadeltareo
 * 
 * @property int $id_prueba_tareo
 * @property Carbon|null $Fecha_prueba
 * @property string|null $img_prueba_tareo
 * @property int $estacion_id
 * 
 * @property Estaciondetrabajo $estaciondetrabajo
 *
 * @package App\Models
 */
class Pruebadeltareo extends Model
{
	protected $table = 'pruebadeltareo';
	protected $primaryKey = 'id_prueba_tareo';
	public $timestamps = false;

	protected $casts = [
		'Fecha_prueba' => 'datetime',
		'estacion_id' => 'int'
	];

	protected $fillable = [
		'Fecha_prueba',
		'img_prueba_tareo',
		'estacion_id'
	];

	public function estaciondetrabajo()
	{
		return $this->belongsTo(Estaciondetrabajo::class, 'estacion_id');
	}
}
