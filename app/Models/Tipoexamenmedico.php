<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipoexamenmedico
 * 
 * @property int $idTipoExamenMedico
 * @property string|null $NombreTipoExamenMedico
 *
 * @package App\Models
 */
class Tipoexamenmedico extends Model
{
	protected $table = 'tipoexamenmedico';
	protected $primaryKey = 'idTipoExamenMedico';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTipoExamenMedico' => 'int'
	];

	protected $fillable = [
		'NombreTipoExamenMedico'
	];
}
