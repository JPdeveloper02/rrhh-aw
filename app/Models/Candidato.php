<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Candidato
 * 
 * @property int $idCandidato
 * @property int $idPersona
 * @property int $MesesDeExperiencia
 * @property int|null $EtapaPrevia
 * @property string $LinkCurriculum
 * @property string|null $observacion
 * @property int|null $EtapaDeLlamada
 * @property int|null $EtapaDeEntrevista
 * @property int|null $EtapaDeContratacion
 * @property int $disponibilidad
 * @property Carbon|null $fecha_disponibilidad
 * @property int|null $idCargoAOptar
 * @property int $id_proceso
 *
 * @package App\Models
 */
class Candidato extends Model
{
	protected $table = 'candidato';
	protected $primaryKey = 'idCandidato';
	public $timestamps = false;

	protected $casts = [
		'idPersona' => 'int',
		'MesesDeExperiencia' => 'int',
		'EtapaPrevia' => 'int',
		'EtapaDeLlamada' => 'int',
		'EtapaDeEntrevista' => 'int',
		'EtapaDeContratacion' => 'int',
		'disponibilidad' => 'int',
		'fecha_disponibilidad' => 'datetime',
		'idCargoAOptar' => 'int',
		'id_proceso' => 'int'
	];

	protected $fillable = [
		'idPersona',
		'MesesDeExperiencia',
		'EtapaPrevia',
		'LinkCurriculum',
		'observacion',
		'EtapaDeLlamada',
		'EtapaDeEntrevista',
		'EtapaDeContratacion',
		'disponibilidad',
		'fecha_disponibilidad',
		'idCargoAOptar',
		'id_proceso'
	];
}
