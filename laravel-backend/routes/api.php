<?php

use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\MahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuratController;

Route::apiResource('/Jadwal', JadwalController::class)->except(['index', 'destroy']);
Route::apiResource('/mahasiswa', MahasiswaController::class)->except(['show']);

// buat route khusus login & register
Route::post('/login', [MahasiswaController::class, 'login']);     // login
Route::post('/register', [MahasiswaController::class, 'store']);    // register
Route::put('/presensi', [JadwalController::class, 'presensi']);


// SURAT
// jenis surat
Route::get('/jenis-surat', [SuratController::class, 'indexJenisSurat']);
Route::post('/jenis-surat', [SuratController::class, 'storeJenisSurat']);
Route::get('/jenis-surat/{id}', [SuratController::class, 'showJenisSurat']);
Route::put('/jenis-surat/{id}', [SuratController::class, 'updateJenisSurat']);
Route::delete('/jenis-surat/{id}', [SuratController::class, 'destroyJenisSurat']);

// pengajuan surat
Route::get('/pengajuan-surat', [SuratController::class, 'indexPengajuanSurat']);
Route::post('/pengajuan-surat', [SuratController::class, 'storePengajuanSurat']);
Route::get('/pengajuan-surat/{id}', [SuratController::class, 'showPengajuanSurat']);
Route::put('/pengajuan-surat/{id}', [SuratController::class, 'updatePengajuanSurat']);
Route::delete('/pengajuan-surat/{id}', [SuratController::class, 'destroyPengajuanSurat']);

Route::patch('/pengajuan-surat/{id}/approve', [SuratController::class, 'approve']);
Route::patch('/pengajuan-surat/{id}/reject', [SuratController::class, 'reject']);


