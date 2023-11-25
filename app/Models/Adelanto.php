<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Adelanto
 * 
 * @property int $idAdelanto
 * @property float $CreditoHastaElMomento
 * @property float $MontoAAdelantar
 * @property string $LinkDeSolicitud
 * @property Carbon $FechaDeDeposito
 *
 * @package App\Models
 */
class Adelanto extends Model
{
	protected $table = 'adelanto';
	protected $primaryKey = 'idAdelanto';
	public $timestamps = false;

	protected $casts = [
		'CreditoHastaElMomento' => 'float',
		'MontoAAdelantar' => 'float',
		'FechaDeDeposito' => 'datetime'
	];

	protected $fillable = [
		'CreditoHastaElMomento',
		'MontoAAdelantar',
		'LinkDeSolicitud',
		'FechaDeDeposito'
	];
}
