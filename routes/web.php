<?php

use App\Http\Controllers\Cargo\CargoController;
use App\Http\Controllers\CTS\CtsController;
use App\Http\Controllers\CumplimientosLegales\CumplimientosLegalesController;
use App\Http\Controllers\Descuentos\DescuentosController;
use App\Http\Controllers\EstacionTrabajo\EstacionTrabajoController;
use App\Http\Controllers\Personal\PersonalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Tareos\TareoController;
use App\Http\Controllers\Tareos\RegistroTareoController;
use App\Http\Controllers\Planilla\PlanillaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Personal\NuevoContratoController;
use App\Http\Controllers\Tareos\PruebasTareoController;
use App\Http\Controllers\Habilitaciones\HabilitacionesController;
use App\Http\Controllers\HoraExtra\HoraExtraController;
use App\Http\Controllers\Personal\EditarDatosController;
use App\Http\Controllers\preboleta\PreboletaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Mail\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware'=> ['auth']], function(){

    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    //Personal
    Route::get('personal',[PersonalController::class, 'verPersonal']);
    Route::get('personal/contrato/{idContrato}',[PersonalController::class, 'contrato']);
    Route::get('personal/perfil/{idContrato}',[PersonalController::class, 'perfil']);
    Route::post('personal/info',[PersonalController::class, 'obtenerDatosPersona'])->name('verPersona');
    Route::post('perfil/subir/contrato',[PersonalController::class, 'perfil_subircontrato']);
    Route::post('perfil/eliminar/contrato',[PersonalController::class,'perfil_eliminarcontrato']);
    Route::post('perfil/editar/fecha',[PersonalController::class,'perfil_editarfecha']);
        //Personal documentos
        //Contratos
        Route::post('personal/guardarContrato',[PersonalController::class, 'guardarDocContrato'])->name('guardarDocContra');
        Route::post('contrato/cese',[PersonalController::class,'cese_contrato'])->name('cese.contrato');
        Route::post('contrato/fin',[PersonalController::class,'fin_contrato'])->name('fin.contrato');
        Route::post('contrato/renovacion',[PersonalController::class,'renovacion'])->name('renovacion.contrato');
        Route::get('descargar/contrato/{idContrato}',[NuevoContratoController::class,'descargar_nuevo_contrato'])->name('descargar_contrato');
        //Descanso medico
        Route::post('personal/descansoMedico',[PersonalController::class, 'descansoMedico'])->name('descanso.medico');
        //Licencia con goce
        Route::post('personal/licencia-con-goce', [PersonalController::class, 'licenciaConGoce'])->name('licencia.Goce');
        //Licencia sin goce
        Route::post('personal/licencia-sin-goce', [PersonalController::class, 'licenciaSinGoce'])->name('licencia.Sin.goce');
        //Otros documentos
        Route::post('personal/otros-documentos', [PersonalController::class, 'otrosDocumentos'])->name('otros.documentos');
        //Nuevo Contrato
        Route::get('nuevo/contrato',[NuevoContratoController::class, 'nuevo_contrato'])->name('nuevo.contrato');
        Route::post('nuevo/contrato/post',[NuevoContratoController::class, 'nuevo_contrato_registro'])->name('registrar.contrato');
        //EDITAR DATOS
        Route::post('editar/datos/personales',[EditarDatosController::class,'datos_personales'])->name('datos.personales');
        Route::post('editar/datos/profesionales',[EditarDatosController::class,'datos_profesionales'])->name('datos.profesionales');
    
    //TAREO
    Route::get('tareos',[TareoController::class, 'index'])->name('tareos');
    Route::post('tareos/estacion',[TareoController::class, 'buscarestacion'])->name('buscarpor.estacion');
    Route::post('tareos/individual',[TareoController::class,'buscar_individual'])->name('tareo.individual');
        //Registrar por router
        Route::post('tareos/router',[RegistroTareoController::class,'tareo_router'])->name('tareo.router');
        //Registrar individual
        Route::post('tareos/individual',[RegistroTareoController::class,'tareo_individual'])->name('tareo.individual');
        //Registrar horas extras
        Route::get('horasextras',[HoraExtraController::class,'horaextra_mostrar'])->name('horasextras');
        Route::post('horasextras',[HoraExtraController::class,'buscar_horasextras'])->name('buscar.horasextras');
        Route::post('tareos/horaextra',[RegistroTareoController::class,'tareo_horaextra'])->name('tareo.horaextra'); 
        Route::post('horasextras/eliminar',[HoraExtraController::class,'eliminar_horaextra'])->name('eliminar_horaextra');
        //Dias Tareados 
        Route::get('tareos/diastareados',[TareoController::class,'mostrar_diastareados']);
        Route::post('tareos/diastareados',[TareoController::class,'buscardiastareados'])->name('buscar.diastareados');
        Route::post('tareos/buscar-id-tareo',[TareoController::class, 'buscarTareo'])->name('buscarTareoId');
        Route::post('tareos/guardar-editar',[TareoController::class, 'guardarEditarTareo'])->name('guardarEditarTareo');
        Route::post('tareos/eliminar-tareo',[TareoController::class,'eliminarTareo'])->name('eliminarTareo');
        Route::get('tareos/ver-tareo/estacion/{idEstacion}/{fecha}',[TareoController::class,'verTareoEstacion'])->name('verTareoEstacion');
        //Fotos tareos
        Route::get('tareos/fotos',[PruebasTareoController::class,'index']);
        Route::post('tareos/fotos/resultado',[PruebasTareoController::class,'buscar_fotos_tareos'])->name('buscar.fotos.tareos');
        Route::post('tareos/fotos/registrar',[PruebasTareoController::class,'registrar_fotos'])->name('registrar.prueba');
        Route::post('tareos/fotos/eliminar',[PruebasTareoController::class,'eliminar_fotos']);
       

    
    //DESCUENTOS
    Route::get('descuentos',[DescuentosController::class,'index']);
    Route::post('descuentos',[DescuentosController::class,'buscar_descuentos'])->name('buscar.descuento');
    Route::post('descuentos/registro',[DescuentosController::class,'registro_descuento'])->name('registro.descuento');
    Route::post('descuentos/eliminar',[DescuentosController::class,'eliminar_descuento']);


    //HABILITACIONES
    Route::get('habilitaciones',[HabilitacionesController::class,'index']);
    Route::get('/obtener-cursos', [HabilitacionesController::class, 'obtener_cursos'])->name('obtener.cursos');
    Route::post('habilitaciones',[HabilitacionesController::class,'habilitaciones_buscar'])->name('habilitaciones.buscar');
    Route::post('habilitaciones/cursos',[HabilitacionesController::class,'cursos'])->name('cursos');
    Route::post('habilitaciones/empleado',[HabilitacionesController::class,'habilitacion_empleado'])->name('habilitacion.empleado');
    
    //CARGOS
    Route::get('cargos',[CargoController::class,'index']);
    Route::post('nuevo/cargo',[CargoController::class,'nuevo_cargo'])->name('nuevo.cargo');
    Route::post('editar/cargo',[CargoController::class,'editar_cargo'])->name('editar.cargo');
    Route::post('eliminar/cargo',[CargoController::class,'eliminar_cargo']);

    //PLANILLA
    Route::get('planilla',[PlanillaController::class,'index']);
    Route::post('planilla',[PlanillaController::class,'BuscarPlanilla'])->name('buscar.planilla');

    //CUMPLIMIENTOS LEGALES
    Route::get('cumplimientos-legales',[CumplimientosLegalesController::class,'index']);

    //PREBOLETA
    Route::post('enviar/preboleta',[PreboletaController::class,'enviar_preboleta'])->name('enviar.preboleta');

    //ESTACION DE TRABAJO
    Route::get('estaciones',[EstacionTrabajoController::class,'index']);
    Route::post('estaciones/estado',[EstacionTrabajoController::class,'editar_estado'])->name('editar.estado');
    Route::post('estaciones/regimen',[EstacionTrabajoController::class,'editar_regimen'])->name('editar.regimen');
    Route::post('estaciones/nueva',[EstacionTrabajoController::class,'nueva_estacion'])->name('nueva.estacion');
    Route::post('estacion/eliminar',[EstacionTrabajoController::class,'eliminar_estacion'])->name('');

    //CTS
    Route::get('cts',[CtsController::class,'index']);
    Route::post('cts',[CtsController::class,'mostrar_cts'])->name('buscar.cts');
});
    //VISTA DE PREBOLETA
    Route::get('preboleta/{idPeriodo}/{idContrato}/{idDatoContable}',[PreboletaController::class,'index']);
