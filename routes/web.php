<?php

use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\IAGenerateController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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

    //IA root
    Route::get('ia-generate', [IAGenerateController::class, 'index'])->name('ia-generate.index');
    Route::post('ia-generate', [IAGenerateController::class, 'generate'])->name('ia-generate.generate');

    //ia root View
    Route::get('/exercice/{id}', [ExerciseController::class, 'show'])->name('exercice.show');

    //Ia exercice index
    Route::get('/exercices', [ExerciseController::class, 'index'])->name('exercices.index');


    //improve content
    Route::post('/exercises/{exercise}/improve', [ExerciseController::class, 'improve'])->name('exercises.improve');
    Route::get('/exercises/{exercise}/compare', [ExerciseController::class, 'compare'])->name('exercises.compare');
    Route::put('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
    Route::post('exercises/{exercise}/correct', [ExerciseController::class, 'correct'])->name('exercises.correct');
    //User LListe root
    Route::resource('users', UserController::class)->except(['create', 'show']);
    Route::post('users/store-admin', [UserController::class, 'storeAdmin'])->name('users.storeAdmin');

    //profil user
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');



});




require __DIR__.'/auth.php';

Route::get('/index', function () {
    return view('index');
});
