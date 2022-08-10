<?php
Route::post('/location/city',[\Alza\Alza_indonesiageografis\LocationController::class,'getcities']);
Route::post('/location/district',[\Alza\Alza_indonesiageografis\LocationController::class,'getdistricts']);
Route::post('/location/subdistrict',[\Alza\Alza_indonesiageografis\LocationController::class,'getsubdistricts']);
