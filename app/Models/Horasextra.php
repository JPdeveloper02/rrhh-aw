<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Horasextra
 * 
 * @property int $idHorasExtras
 * @property string $LinkDocumento
 * @property Carbon $HoraDeRegistro
 * @property float|null $ValorDe25
 * @property float|null $ValorDe35
 *
 * @package App\Models
 */
class Horasextra extends Model
{
	protected $table = 'horasextras';
	protected $primaryKey = 'idHorasExtras';
	public $timestamps = false;

	protected $casts = [
		'HoraDeRegistro' => 'datetime',
		'ValorDe25' => 'float',
		'ValorDe35' => 'float'
	];

	protected $fillable = [
		'LinkDocumento',
		'HoraDeRegistro',
		'ValorDe25',
		'ValorDe35'
	];
}
