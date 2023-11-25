<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDocumento
 * 
 * @property int $id_tipodocumento
 * @property string|null $tipo
 * @property string|null $comentario
 * 
 * @property Collection|Documento[] $documentos
 *
 * @package App\Models
 */
class TipoDocumento extends Model
{
	protected $table = 'tipo_documento';
	protected $primaryKey = 'id_tipodocumento';
	public $timestamps = false;

	protected $fillable = [
		'tipo',
		'comentario'
	];

	public function documentos()
	{
		return $this->hasMany(Documento::class, 'id_tipodocumento');
	}
}
