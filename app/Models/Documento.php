<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Documento
 * 
 * @property int $id_documento
 * @property int $id_tipodocumento
 * @property int|null $id_empleado
 * @property Carbon|null $fecha_registro
 * @property string|null $documento
 * @property string|null $comentario
 * 
 * @property Empleado|null $empleado
 * @property TipoDocumento $tipo_documento
 *
 * @package App\Models
 */
class Documento extends Model
{
	protected $table = 'documentos';
	protected $primaryKey = 'id_documento';
	public $timestamps = false;

	protected $casts = [
		'id_tipodocumento' => 'int',
		'id_empleado' => 'int',
		'fecha_registro' => 'datetime'
	];

	protected $fillable = [
		'id_tipodocumento',
		'id_empleado',
		'fecha_registro',
		'documento',
		'comentario'
	];

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'id_empleado');
	}

	public function tipo_documento()
	{
		return $this->belongsTo(TipoDocumento::class, 'id_tipodocumento');
	}
}
