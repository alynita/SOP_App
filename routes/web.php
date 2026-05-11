<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SopController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

// 🔥 Paksa ke login
Route::get('/', function () {
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Login, Register, dll)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |------------------------------------------
    | DASHBOARD
    |------------------------------------------
    */

    Route::get('/dashboard', [SopController::class, 'dashboard']);

    Route::get('/dashboard-timker4', function () {
        if (auth()->user()->role != 'timker4') {
            abort(403);
        }

        return app(DashboardController::class)->dashboardTimker4();
    });


    /*
    |------------------------------------------
    | SOP (INPUT & DATA)
    |------------------------------------------
    */

    // 🔥 Input SOP (dipindah dari / ke sini)
    Route::get('/sop/create', [SopController::class, 'create']);
    Route::post('/sop/store', [SopController::class, 'store']);

    // List SOP
    Route::get('/sop', [SopController::class, 'index']);
    Route::get('/proses-sop', [SopController::class, 'proses']);

    /*
    |------------------------------------------
    | STEP SOP
    |------------------------------------------
    */

    Route::get('/sop/{id}/dasar-hukum', [SopController::class, 'dasarHukum']);
    Route::post('/sop/{id}/dasar-hukum', [SopController::class, 'storeDasarHukum']);

    Route::get('/sop/{id}/kualifikasi', [SopController::class, 'kualifikasi']);
    Route::post('/sop/{id}/kualifikasi', [SopController::class, 'storeKualifikasi']);

    Route::get('/sop/{id}/keterkaitan', [SopController::class, 'keterkaitan']);
    Route::post('/sop/{id}/keterkaitan', [SopController::class, 'storeKeterkaitan']);

    Route::get('/sop/{id}/peralatan', [SopController::class, 'peralatan']);
    Route::post('/sop/{id}/peralatan', [SopController::class, 'storePeralatan']);

    Route::get('/sop/{id}/peringatan', [SopController::class, 'peringatan']);
    Route::post('/sop/{id}/peringatan', [SopController::class, 'storePeringatan']);

    Route::get('/sop/{id}/pencatatan', [SopController::class, 'pencatatan']);
    Route::post('/sop/{id}/pencatatan', [SopController::class, 'storePencatatan']);

    Route::get('/sop/{id}/kegiatan', [SopController::class, 'kegiatan']);
    Route::post('/sop/{id}/kegiatan', [SopController::class, 'storeKegiatan']);

    Route::get('/sop/{id}/diagram', [SopController::class, 'diagram']);


    /*
    |------------------------------------------
    | OUTPUT & EDIT SOP
    |------------------------------------------
    */

    Route::get('/sop/{id}', [SopController::class, 'show']);

    Route::get('/sop/{id}/edit', [SopController::class, 'edit']);
    Route::post('/sop/{id}/update', [SopController::class, 'update']);
    Route::get('/sop/{id}/delete', [SopController::class, 'delete']);
    Route::post('/sop/{id}/submit', [SopController::class, 'submit']);

    
    Route::get('/sop/{id}/kegiatan/edit',
        [SopController::class, 'editKegiatan']);

    Route::post('/sop/{id}/kegiatan/update',
        [SopController::class, 'updateKegiatan']);


    /*
    |------------------------------------------
    | APPROVAL (TIMKER 4)
    |------------------------------------------
    */

    Route::post('/sop/{id}/approve', [SopController::class, 'approve']);
    Route::post('/sop/{id}/reject', [SopController::class, 'reject']);


    /*
    |------------------------------------------
    | PROFILE
    |------------------------------------------
    */

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});