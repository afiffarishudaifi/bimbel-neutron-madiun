<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signin', [App\Http\Controllers\Api\AuthsiswaController::class,'signin']);
Route::post('/signup', [App\Http\Controllers\Api\AuthsiswaController::class,'signup']);
Route::post('/jadwal', [App\Http\Controllers\Api\JadwalController::class,'index']);
Route::get('/about', [App\Http\Controllers\Api\AboutController::class,'index']);
Route::post('/jadwalforum', [App\Http\Controllers\Api\JadwalForumController::class,'index']);
Route::get('/detil/materitext/{id}', [App\Http\Controllers\Api\DetilmateritextController::class,'index']);
Route::post('/matericategory', [App\Http\Controllers\Api\MatericategoryController::class,'index']);
Route::post('/materitext', [App\Http\Controllers\Api\MateritextController::class,'index']);
Route::post('/materivideo', [App\Http\Controllers\Api\MaterivideoController::class,'index']);
Route::post('/groupsoal', [App\Http\Controllers\Api\GroupsoalController::class,'index']);
Route::post('/topic', [App\Http\Controllers\Api\TopicController::class,'index']);
Route::get('/topic/detil/{id}',[\App\Http\Controllers\Api\TopicdetilController::class,'index']);
Route::get('/catatangroupsoal/{id}', [App\Http\Controllers\Api\GroupsoalController::class,'catatan']);
Route::get('/soal/{id}', [App\Http\Controllers\Api\SoalController::class,'index']);
Route::get('/nilai/{id}', [App\Http\Controllers\Api\NilaiController::class,'index']);
Route::post('/postjawaban', [App\Http\Controllers\Api\PostJawabanController::class,'index']);
Route::post('/forum/posttopic', [App\Http\Controllers\Api\ForumController::class,'simpan_post']);
Route::put('/akun/update/{id}', [App\Http\Controllers\Api\AkunController::class,'update']);
Route::post('/forum/repliestopic', [App\Http\Controllers\Api\ForumController::class,'simpan_replies']);
Route::get('/forum/hapustopic/{id}', [App\Http\Controllers\Api\ForumController::class,'hapus_post']);
Route::get('/forum/hapusreplies/{id}', [App\Http\Controllers\Api\ForumController::class,'hapus_replies']);
