<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjekController;

Route::get('', [UserController::class, 'home']);

Route::middleware(['auth'])->group(function () {
    Route::get('projek', [ProjekController::class, 'senarai']);
    Route::post('projek', [ProjekController::class, 'cipta']);
    Route::get('projek/{id}', [ProjekController::class, 'satu']);
    Route::put('projek/{id}', [ProjekController::class, 'kemaskini']);
    Route::post('projek/{id}/user', [ProjekController::class, 'cipta_user']);
});

require __DIR__.'/auth.php';
