<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SopController;

// INPUT SOP (STEP 1)
Route::get('/', [SopController::class, 'create']);
Route::post('/sop/store', [SopController::class, 'store']);

// 🔥 DATA SOP (LIST)
Route::get('/sop', [SopController::class, 'index']);

Route::get('/dashboard', [SopController::class, 'dashboard']);

// STEP ROUTES
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

// OUTPUT
Route::get('/sop/{id}', [SopController::class, 'show']);

//UPDATE
Route::get('/sop/{id}/edit', [SopController::class, 'edit']);
Route::post('/sop/{id}/update', [SopController::class, 'update']);
Route::get('/sop/{id}/delete', [SopController::class, 'delete']);