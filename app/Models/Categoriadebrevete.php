<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoriadebrevete
 * 
 * @property int $idCategoriaDeBrevete
 * @property string|null $NombreCategoriaDeBrevete
 *
 * @package App\Models
 */
class Categoriadebrevete extends Model
{
	protected $table = 'categoriadebrevete';
	protected $primaryKey = 'idCategoriaDeBrevete';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCategoriaDeBrevete' => 'int'
	];

	protected $fillable = [
		'NombreCategoriaDeBrevete'
	];
}
