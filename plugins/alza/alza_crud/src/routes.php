<?php
Route::group(['prefix' => config('pathadmin.admin_name'), 'as' => config('pathadmin.admin_prefix'),'middleware' => ['web','auth']], function() {
    Route::get('/crudgenerator',function(){
        return view('crud::index');
    });
    Route::post('/crud/insert',[\Alza\Alza_crud\CrudController::class,'insert'])->name('crud.insert');
});
