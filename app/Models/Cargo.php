<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cargo
 * 
 * @property int $idCargo
 * @property string|null $NombreCargo
 *
 * @package App\Models
 */
class Cargo extends Model
{
	protected $table = 'cargo';
	protected $primaryKey = 'idCargo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCargo' => 'int'
	];

	protected $fillable = [
		'NombreCargo'
	];
}
