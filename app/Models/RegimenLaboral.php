<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegimenLaboral
 * 
 * @property int $idRegimenLaboral
 * @property string $tipo
 * 
 * @property Collection|Estaciondetrabajo[] $estaciondetrabajos
 *
 * @package App\Models
 */
class RegimenLaboral extends Model
{
	protected $table = 'regimen_laboral';
	protected $primaryKey = 'idRegimenLaboral';
	public $timestamps = false;

	protected $fillable = [
		'tipo'
	];

	public function estaciondetrabajos()
	{
		return $this->hasMany(Estaciondetrabajo::class, 'idRegimenLaboral');
	}
}
