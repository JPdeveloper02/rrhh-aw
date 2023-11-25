<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Login
 * 
 * @property int $idLogin
 * @property string|null $email
 * @property string|null $password
 * @property int|null $PersonaId
 *
 * @package App\Models
 */
class Login extends Model
{
	protected $table = 'login';
	protected $primaryKey = 'idLogin';
	public $timestamps = false;

	protected $casts = [
		'PersonaId' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'password',
		'PersonaId'
	];
}
