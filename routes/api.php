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
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SecretariaGeneral1Controller;
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

Route::resource('proceso', ProcesoController::class);

Route::resource('grado', GradoController::class);
Route::resource('modalidades', ModalidadController::class);
Route::resource('fase',FaseController::class);
Route::resource('faserequisito',FaseRequisitoController::class);
Route::resource('requisito',RequisitoController::class);
Route::resource('persona',PersonaController::class);
Route::resource('tipoarchivo',TipoArchivoController::class);
Route::resource('rol',RolController::class);

Route::resource('bachillerIni',BachillerIniController::class);
Route::resource('bachillerFinal',BachillerFinalController::class);

Route::get('buscardni/{codigo}', [PersonaController::class, 'buscardniuser']);
Route::get('facuescuela',[FacultadEscuelaController::class,'facultad']);
Route::get('ver/{id}',[FaseRequisitoController::class,'ver']);

Route::get('mostrarescuela/{codigo}',[FacultadEscuelaController::class,'escuelas']);
Route::get('rolesgenerales/{codigo}',[FacultadEscuelaController::class,'rolesgenerales']);
Route::resource('adminuser',AdminUserController::class);
Route::get('disableRol/{id}',[AdminUserController::class,'disablerol']);
Route::get('cambiarEstado/{id}', [ProcesoController::class, 'cambiarEstado']);
Route::get('cambiarGuardado/{id}', [ProcesoController::class, 'cambiarGuardado']);

//pdf
Route::post('/generatePDF', [PdfController::class,'Addtopdf']);
Route::get('/editor',[EditorController::class,'editor']);

//alumno
Route::resource('tramite',tramiteController::class);
Route::get('fasestramite/{codigo}',[tramiteController::class,'obtenerfases']);
Route::get('alu-faserequisito/{id}/{tramite}',[tramiteController::class,'obtenerfaserequisito']);
Route::post('alu-filerequisito/',[tramiteController::class,'subirarchivorequisito']);
Route::get('alu_autorized/{fase}/{tramite}',[tramiteController::class,'alu_autorized']);
Route::get('alu-notificarcambio/{fase}/{tramite}',[tramiteController::class,'alu_notificarCambio']);
Route::get('alu-proceso',[tramiteController::class,'alu_procesos']);



//rutas secretaria facultad 

Route::get('sf-expedientes',[SecretariaController::class,'sf_expedientes']);
Route::get('sf-tramite/{id}',[SecretariaController::class,'sf_obtenertramite']);
Route::get('sf-fasestramite/{id}',[SecretariaController::class,'sf_obtenerfasestramite']);
Route::get('sf-faserequisito/{id}/{tramite}',[SecretariaController::class,'sf_requisitosfase']);
Route::get('sf-archivorequisito/{tramite}/{fasereq}',[SecretariaController::class,'sf_archivorequisito']);
Route::post('sf-revisarrequisito',[SecretariaController::class,'sf_revisarrequisito']);
Route::post('sf-subirfilerequisito',[SecretariaController::class,'sf_subirrequisito']);
Route::get('sf-fasecheck/{tramite}/{fase}',[SecretariaController::class,'sf_fasecheck']);

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
Route::post('aprobar-consejo',[SecretariaGeneral1Controller::class,'sg1_apro_consejo']);
Route::get('expd_aprobados',[SecretariaGeneral1Controller::class,'expedientes_aprobados']);
