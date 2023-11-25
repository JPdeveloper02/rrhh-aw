<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Condiciondetareo
 * 
 * @property int $idCondicionDeTareo
 * @property string|null $NombreCondicionDeTareo
 *
 * @package App\Models
 */
class Condiciondetareo extends Model
{
	protected $table = 'condiciondetareo';
	protected $primaryKey = 'idCondicionDeTareo';
	public $timestamps = false;

	protected $fillable = [
		'NombreCondicionDeTareo'
	];
}
