<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Motivodecese
 * 
 * @property int $idMotivosDeCese
 * @property string $NombreMotivosDeCese
 *
 * @package App\Models
 */
class Motivodecese extends Model
{
	protected $table = 'motivodecese';
	protected $primaryKey = 'idMotivosDeCese';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idMotivosDeCese' => 'int'
	];

	protected $fillable = [
		'NombreMotivosDeCese'
	];
}
