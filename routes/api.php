<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjekController;

use App\Http\Controllers\FgvPmpsController;

Route::post('login', [ProjekController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('fgv-pmps')->group(function () {
        
        Route::get('profil', [FgvPmpsController::class, 'profil']);

        Route::get('tugasan', [FgvPmpsController::class, 'senarai_tugasan']);
        Route::post('tugasan', [FgvPmpsController::class, 'cipta_tugasan']);
        Route::get('tugasan/{id}', [FgvPmpsController::class, 'satu_tugasan']);
        Route::put('tugasan/{id}/siap', [FgvPmpsController::class, 'siap_tugasan']);
        Route::put('tugasan/{id}/sah', [FgvPmpsController::class, 'sah_tugasan']);

        Route::post('hubungan', [FgvPmpsController::class, 'hubungan']);
        Route::post('rosak', [FgvPmpsController::class, 'lapor_rosak']);

    });

});

