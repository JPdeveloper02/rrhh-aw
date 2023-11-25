<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bono
 * 
 * @property int $idBonos
 * @property int|null $idContrato
 * @property int|null $idPeriodo
 * @property int|null $idGratificacion
 * @property float|null $PagoHorasExtras
 * @property float|null $Reintegro
 * @property float|null $BonoDeclarado
 * @property float|null $BonoProduce
 * @property float|null $BonoNoche
 * @property float|null $BonoConductor
 * @property float|null $BonoRotacion
 * @property float|null $BonoAsignacionFamiliar
 *
 * @package App\Models
 */
class Bono extends Model
{
	protected $table = 'bonos';
	protected $primaryKey = 'idBonos';
	public $timestamps = false;

	protected $casts = [
		'idContrato' => 'int',
		'idPeriodo' => 'int',
		'idGratificacion' => 'int',
		'PagoHorasExtras' => 'float',
		'Reintegro' => 'float',
		'BonoDeclarado' => 'float',
		'BonoProduce' => 'float',
		'BonoNoche' => 'float',
		'BonoConductor' => 'float',
		'BonoRotacion' => 'float',
		'BonoAsignacionFamiliar' => 'float'
	];

	protected $fillable = [
		'idContrato',
		'idPeriodo',
		'idGratificacion',
		'PagoHorasExtras',
		'Reintegro',
		'BonoDeclarado',
		'BonoProduce',
		'BonoNoche',
		'BonoConductor',
		'BonoRotacion',
		'BonoAsignacionFamiliar'
	];
}
