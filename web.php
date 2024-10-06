<?php

use App\Http\Controllers\ProjekController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

Route::get('/projek', [ProjekController::class, 'index'])->name('projek.index');
Route::get('/projek/create', [ProjekController::class, 'create'])->name('projek.create');
Route::post('/projek', [ProjekController::class, 'store'])->name('projek.store');
Route::get('/projek/{id}', [ProjekController::class, 'show'])->name('projek.show');
Route::get('/projek/edit/{id}', [ProjekController::class, 'edit'])->name('projek.edit');
Route::put('/projek/{id}', [ProjekController::class, 'update'])->name('projek.update');
Route::delete('/projek/{id}', [ProjekController::class, 'destroy'])->name('projek.destroy');

