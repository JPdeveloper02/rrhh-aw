<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tiposeguro
 * 
 * @property int $idtiposeguro
 * @property string|null $nombreSeguro
 *
 * @package App\Models
 */
class Tiposeguro extends Model
{
	protected $table = 'tiposeguro';
	protected $primaryKey = 'idtiposeguro';
	public $timestamps = false;

	protected $fillable = [
		'nombreSeguro'
	];
}
