<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Epp
 * 
 * @property int $idEpps
 * @property string|null $nombreEpp
 *
 * @package App\Models
 */
class Epp extends Model
{
	protected $table = 'epps';
	protected $primaryKey = 'idEpps';
	public $timestamps = false;

	protected $fillable = [
		'nombreEpp'
	];
}
