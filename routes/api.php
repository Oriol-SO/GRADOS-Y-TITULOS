<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\ModalidadController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\FaseRequisitoController;
use App\Http\Controllers\RequisitoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TipoArchivoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\BachillerFinalController;
use App\Http\Controllers\BachillerIniController;
use App\Http\Controllers\FacultadEscuelaController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SecretariaGeneral1Controller;
use App\Http\Controllers\SecretariaGeneral2Controller;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\tramiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecretariaVicerrectoradoController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
      //para cambiar rol
    Route::post('cambiar-rol/{id}',[UserController::class,'cambiar_rol']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'RegistrarUser']);
    Route::get('datauser/{codigo}', [RegisterController::class, 'datosusuario']);   

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
    
});



Route::group(['middleware'=>'admin:api'],function(){
    Route::post('agregar_proceso',[ProcesoController::class,'agregar_proceso']);
    Route::resource('proceso', ProcesoController::class);
    Route::resource('fase',FaseController::class);    
    Route::resource('grado', GradoController::class);
    Route::resource('modalidades', ModalidadController::class);
    Route::resource('faserequisito',FaseRequisitoController::class);
    Route::resource('requisito',RequisitoController::class);
    Route::resource('persona',PersonaController::class);
    Route::resource('tipoarchivo',TipoArchivoController::class);
    Route::resource('rol',RolController::class);
    Route::get('roles/{fase}',[FaseController::class,'roles']);
    Route::get('buscardni/{codigo}', [PersonaController::class, 'buscardniuser']);
    Route::get('facuescuela',[FacultadEscuelaController::class,'facultad']);
    Route::get('ver/{id}',[FaseRequisitoController::class,'ver']);

    Route::get('mostrarescuela/{codigo}',[FacultadEscuelaController::class,'escuelas']);
    Route::get('rolesgenerales/{codigo}',[FacultadEscuelaController::class,'rolesgenerales']);
    Route::resource('adminuser',AdminUserController::class);
    Route::get('disableRol/{id}',[AdminUserController::class,'disablerol']);
    Route::get('cambiarEstado/{id}', [ProcesoController::class, 'cambiarEstado']);
    Route::get('cambiarGuardado/{id}', [ProcesoController::class, 'cambiarGuardado']);
});

Route::group(['middleware' => 'auth:api'], function () {

Route::resource('bachillerIni',BachillerIniController::class);
Route::resource('bachillerFinal',BachillerFinalController::class);



//pdf
Route::post('/generatePDF', [PdfController::class,'Addtopdf']);
Route::get('/editor',[EditorController::class,'editor']);

//alumno
Route::resource('tramite',tramiteController::class);
Route::post('agregartramite',[tramiteController::class,'agregar_tramite']);
Route::get('fasestramite/{codigo}',[tramiteController::class,'obtenerfases']);
Route::get('alu-faserequisito/{id}/{tramite}',[tramiteController::class,'obtenerfaserequisito']);
Route::post('alu-filerequisito/',[tramiteController::class,'subirarchivorequisito']);
Route::get('alu_autorized/{fase}/{tramite}',[tramiteController::class,'alu_autorized']);
Route::get('alu-proceso/{id}',[tramiteController::class,'alu_procesos']);
Route::get('alu-grados',[tramiteController::class,'alu_grados']);

//lineas de investigacion
Route::get('lineas-inv',[tramiteController::class,'lineas_inv']);


//notificar cambios del tramite
Route::get('notificarcambio-tramite/{fase}/{tramite}',[tramiteController::class,'notificarCambio']);

//rutas secretaria facultad 

Route::get('sf-expedientes',[SecretariaController::class,'sf_expedientes']);
Route::get('sf-tramite/{id}',[SecretariaController::class,'sf_obtenertramite']);
Route::get('sf-fasestramite/{id}',[SecretariaController::class,'sf_obtenerfasestramite']);
Route::get('sf-faserequisito/{id}/{tramite}',[SecretariaController::class,'sf_requisitosfase']);
Route::get('sf-archivorequisito/{tramite}/{fasereq}',[SecretariaController::class,'sf_archivorequisito']);
Route::post('sf-revisarrequisito',[SecretariaController::class,'sf_revisarrequisito']);
Route::post('sf-subirfilerequisito',[SecretariaController::class,'sf_subirrequisito']);
Route::get('sf-fasecheck/{tramite}/{fase}',[SecretariaController::class,'sf_fasecheck']);
Route::get('sf-asesores',[SecretariaController::class,'lista_asesor']);
Route::post('sf-asignar-asesor/{tramite}',[SecretariaController::class,'sf_asignar_asesor']);


//rutas vicerrectorado

Route::get('sv-expedientes',[SecretariaVicerrectoradoController::class,'sv_expedientes']);
//Route::get('sf-tramite/{id}',[SecretariaController::class,'sf_obtenertramite']);
Route::get('sv-fasestramite/{id}',[SecretariaVicerrectoradoController::class,'sv_obtenerfasestramite']);
Route::get('sv-faserequisito/{id}/{tramite}',[SecretariaVicerrectoradoController::class,'sv_requisitosfase']);
Route::post('sv-revisarrequisito',[SecretariaVicerrectoradoController::class,'sv_revisarrequisito']);
Route::post('sv-subirfilerequisito',[SecretariaVicerrectoradoController::class,'sv_subirrequisito']);
Route::get('sv-fasecheck/{tramite}/{fase}',[SecretariaVicerrectoradoController::class,'sv_fasecheck']);

//rutas scretaria general 1
Route::get('sg1-expedientes',[SecretariaGeneral1Controller::class,'index']);
Route::post('agendarExpediente',[SecretariaGeneral1Controller::class,'sg1_agendar_expediente']);
Route::get('expd-agendados',[SecretariaGeneral1Controller::class,'expedientes_agendados']);
Route::get('sg1-resoluciones',[SecretariaGeneral1Controller::class,'sg1_resoluciones']);
Route::post('aprobar-consejo/{id}',[SecretariaGeneral1Controller::class,'sg1_apro_consejo']);
Route::post('aprobar-resolucion',[SecretariaGeneral1Controller::class,'sg1_apro_resolucion']);
Route::post('enviar-datos-reso-interno',[SecretariaGeneral1Controller::class,'enviar_datos_resolucion_internos']);
Route::get('expd_aprobados/{id}',[SecretariaGeneral1Controller::class,'expedientes_aprobados']);

Route::get('secre-gen-grado',[SecretariaGeneral1Controller::class,'sq1_grados']);
Route::get('expd_con_resolu/{id}',[SecretariaGeneral1Controller::class,'sg1_expe_con_resolucion']);
Route::get('get_60_campos/{id}',[SecretariaGeneral1Controller::class,'sg_get_60_campos']);
Route::get('sg1-expe-impresos/{id}',[SecretariaGeneral1Controller::class,'sg1_expe_impresos']);
Route::post('sg1-add-sticker',[SecretariaGeneral1Controller::class,'sg1_add_sticker']);
Route::get('sg1-get-sunedu',[SecretariaGeneral1Controller::class,'sg1_get_sunedu']);

Route::get('sg2_expd_aprobados/{id}',[SecretariaGeneral2Controller::class,'sg2_expedientes_aprobados']);
Route::get('sg2_datos_internos_imprimir/{id}',[SecretariaGeneral2Controller::class,'sg2_get_imprimir']);
Route::get('sg2-get-programar/{id}',[SecretariaGeneral2Controller::class,'sg2_get_programar']);
Route::post('imprimir',[SecretariaGeneral2Controller::class,'sg2_post_imprimir']);
Route::post('sg2-add-fecha-entrega',[SecretariaGeneral2Controller::class,'sg2_add_fecha_entrega']);
Route::get('sg2-get-programados/{id}',[SecretariaGeneral2Controller::class,'sg2_get_programados']);
Route::post('sg2-entregar/{id}',[SecretariaGeneral2Controller::class,'sg2_entregar']);

//asesor

Route::get('asesor-expediente',[AsesorController::class,'asesor_expedientes']);

});