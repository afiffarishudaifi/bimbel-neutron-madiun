<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', function () {
    return view('alza_admin.alza_modul.alza_dashboard');
})->middleware('auth');
Route::group(['prefix' => config('pathadmin.admin_name'), 'as' => config('pathadmin.admin_prefix'), 'middleware' => ['auth:pengajar,web']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('roles', Alza_admin\RoleController::class);
    Route::resource('users', Alza_admin\UserController::class);
    Route::resource('permissions', Alza_admin\PermissionController::class);
    Route::get('/menus',[App\Http\Controllers\Alza_admin\MenuController::class,'index']);
    Route::get('/iden',[App\Http\Controllers\Alza_admin\IdentitasController::class, 'index'])->name('iden.index');
    Route::put('/iden/update/{iden}',[App\Http\Controllers\Alza_admin\IdentitasController::class, 'update'])->name('iden.update');
	Route::resource('/siswas', Alza_admin\SiswaController::class);
	Route::resource('/kelass', Alza_admin\KelasController::class);
	Route::resource('/jenjangs', Alza_admin\JenjangController::class);
	Route::resource('/semesters', Alza_admin\SemesterController::class);
	Route::resource('/pengajars', Alza_admin\PengajarController::class);
	Route::resource('/mapels', Alza_admin\MapelController::class);
	Route::resource('/entitass', Alza_admin\EntitasController::class);
	Route::resource('/matervideos', Alza_admin\MatervideoController::class);
	Route::resource('/rombels', Alza_admin\RombelController::class);
    Route::post('/searchsiswa',[App\Http\Controllers\Service\DatasiswaController::class,'index']);
	Route::resource('/groupsoals', Alza_admin\GroupsoalController::class);
	Route::resource('/soals', Alza_admin\SoalController::class);
	Route::resource('/jawabans', Alza_admin\JawabanController::class);
	Route::resource('/materitexts', Alza_admin\MateritextController::class);
	Route::resource('/jadwals', Alza_admin\JadwalController::class);
	Route::resource('/matericategorys', Alza_admin\MatericategoryController::class);
    Route::get('/topics/{id}/show',[App\Http\Controllers\Alza_admin\TopicController::class,'show']);
	Route::resource('/topics', Alza_admin\TopicController::class);
	Route::resource('/posts', Alza_admin\PostController::class);
	Route::resource('/replies', Alza_admin\ReplieController::class);
	/*new route*/
});
