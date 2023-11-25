<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estaciondetrabajo
 * 
 * @property int $idEstacionDeTrabajo
 * @property string|null $NombreEstacionDeTrabajo
 * @property int|null $idRegimenLaboral
 * 
 * @property RegimenLaboral|null $regimen_laboral
 * @property Collection|Pruebadeltareo[] $pruebadeltareos
 *
 * @package App\Models
 */
class Estaciondetrabajo extends Model
{
	protected $table = 'estaciondetrabajo';
	protected $primaryKey = 'idEstacionDeTrabajo';
	public $timestamps = false;

	protected $casts = [
		'idRegimenLaboral' => 'int'
	];

	protected $fillable = [
		'NombreEstacionDeTrabajo',
		'idRegimenLaboral'
	];

	public function regimen_laboral()
	{
		return $this->belongsTo(RegimenLaboral::class, 'idRegimenLaboral');
	}

	public function pruebadeltareos()
	{
		return $this->hasMany(Pruebadeltareo::class, 'estacion_id');
	}
}
