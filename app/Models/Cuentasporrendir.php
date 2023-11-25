<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuentasporrendir
 * 
 * @property int $idCuentasPorRendir
 * @property Carbon $DiaDeRegistro
 * @property string $Motivo
 * @property float $Monto
 * @property int $idContrato
 *
 * @package App\Models
 */
class Cuentasporrendir extends Model
{
	protected $table = 'cuentasporrendir';
	protected $primaryKey = 'idCuentasPorRendir';
	public $timestamps = false;

	protected $casts = [
		'DiaDeRegistro' => 'datetime',
		'Monto' => 'float',
		'idContrato' => 'int'
	];

	protected $fillable = [
		'DiaDeRegistro',
		'Motivo',
		'Monto',
		'idContrato'
	];
}
