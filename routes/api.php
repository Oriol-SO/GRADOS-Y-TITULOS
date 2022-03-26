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
use App\Http\Controllers\SecretariaGeneral1Controller;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\tramiteController;
use Illuminate\Support\Facades\Route;


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
    Route::post('register', [RegisterController::class, 'register']);
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

Route::get('mostrarescuela/{codigo}',[FacultadEscuelaController::class,'escuelas']);
Route::get('rolesgenerales/{codigo}',[FacultadEscuelaController::class,'rolesgenerales']);
Route::resource('adminuser',AdminUserController::class);

//alumno
Route::resource('tramite',tramiteController::class);
Route::get('fasestramite/{codigo}',[tramiteController::class,'obtenerfases']);


//rutas scretaria general 1

Route::get('expedientes',[SecretariaGeneral1Controller::class,'index']);

//rutas secretaria facultad 

Route::get('sf-expedientes',[SecretariaController::class,'sf_expedientes']);