<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Condiciondecontrato
 * 
 * @property int $idCondicionDeContrato
 * @property string|null $NombreCondicionDeContrato
 *
 * @package App\Models
 */
class Condiciondecontrato extends Model
{
	protected $table = 'condiciondecontrato';
	protected $primaryKey = 'idCondicionDeContrato';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCondicionDeContrato' => 'int'
	];

	protected $fillable = [
		'NombreCondicionDeContrato'
	];
}
