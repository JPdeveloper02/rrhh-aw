<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Datosprofesionale
 * 
 * @property int $idDatosProfesionales
 * @property int|null $idEmpleado
 * @property string|null $Profesion
 * @property int|null $idCampoDeEstudio
 * @property int|null $MesesDeExperiencia
 * @property int|null $idCategoriaDeBrevete
 *
 * @package App\Models
 */
class Datosprofesionale extends Model
{
	protected $table = 'datosprofesionales';
	protected $primaryKey = 'idDatosProfesionales';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idDatosProfesionales' => 'int',
		'idEmpleado' => 'int',
		'idCampoDeEstudio' => 'int',
		'MesesDeExperiencia' => 'int',
		'idCategoriaDeBrevete' => 'int'
	];

	protected $fillable = [
		'idEmpleado',
		'Profesion',
		'idCampoDeEstudio',
		'MesesDeExperiencia',
		'idCategoriaDeBrevete'
	];
}
