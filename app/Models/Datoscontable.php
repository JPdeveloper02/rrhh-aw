<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Datoscontable
 * 
 * @property int $idDatosContables
 * @property float $SueldoBase
 * @property string|null $CISPP
 * @property int $NHijos
 * @property int $idContrato
 * @property float|null $pensionAlimenticia
 *
 * @package App\Models
 */
class Datoscontable extends Model
{
	protected $table = 'datoscontables';
	protected $primaryKey = 'idDatosContables';
	public $timestamps = false;

	protected $casts = [
		'SueldoBase' => 'float',
		'NHijos' => 'int',
		'idContrato' => 'int',
		'pensionAlimenticia' => 'float'
	];

	protected $fillable = [
		'SueldoBase',
		'CISPP',
		'NHijos',
		'idContrato',
		'pensionAlimenticia'
	];
}
