<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 * 
 * @property int $idEmpleado
 * @property int $idPersona
 * @property int $idCargo
 * @property int $idFondoDePension
 * @property string|null $constanciaAfiliacionFP
 * @property int|null $altaSunat
 * 
 * @property Collection|Documento[] $documentos
 *
 * @package App\Models
 */
class Empleado extends Model
{
	protected $table = 'empleado';
	protected $primaryKey = 'idEmpleado';
	public $timestamps = false;

	protected $casts = [
		'idPersona' => 'int',
		'idCargo' => 'int',
		'idFondoDePension' => 'int',
		'altaSunat' => 'int'
	];

	protected $fillable = [
		'idPersona',
		'idCargo',
		'idFondoDePension',
		'constanciaAfiliacionFP',
		'altaSunat'
	];

	public function documentos()
	{
		return $this->hasMany(Documento::class, 'id_empleado');
	}
}
