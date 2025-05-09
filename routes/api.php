<?php

use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/mahasiswa',[MahasiswaController::class,'getMahasiswa']);

Route::post('mahasiswa',[MahasiswaController::class, 'tambahData']);

Route::put('mahasiswa/{mahasiswa:nim}', [MahasiswaController::class,'updateData']);

Route::delete('mahasiswa/{mahasiswa:nim}', [MahasiswaController::class,'deleteData']);

Route::patch('mahasiswa/{mahasiswa:nim}', [MahasiswaController::class,'patchData']);
