<?php

use App\Http\Controllers\ChapitreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes protégées par authentification pour les matières
    Route::get('matieres', [MatiereController::class, 'index'])->name('matieres.index');
    Route::get('matieres/create', [MatiereController::class, 'create'])->name('matieres.create');
    Route::post('matieres', [MatiereController::class, 'store'])->name('matieres.store');
    Route::get('matieres/{matiere}/edit', [MatiereController::class, 'edit'])->name('matieres.edit');
    Route::put('matieres/{matiere}', [MatiereController::class, 'update'])->name('matieres.update');
    Route::delete('matieres/{matiere}', [MatiereController::class, 'destroy'])->name('matieres.destroy');


    // Routes protégées par authentification pour les chapptre
    Route::get('chapitres', [ChapitreController::class, 'index'])->name('chapitres.index');
    Route::get('chapitres/create', [ChapitreController::class, 'create'])->name('chapitres.create');
    Route::post('chapitres', [ChapitreController::class, 'store'])->name('chapitres.store');
    Route::get('chapitres/{chapitre}/edit', [ChapitreController::class, 'edit'])->name('chapitres.edit');
    Route::put('chapitres/{chapitre}', [ChapitreController::class, 'update'])->name('chapitres.update');
    Route::delete('chapitres/{chapitre}', [ChapitreController::class, 'destroy'])->name('chapitres.destroy');
});

require __DIR__.'/auth.php';

Route::get('/index', function () {
    return view('index');
});
