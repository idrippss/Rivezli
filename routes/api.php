<?php

use App\Http\Controllers\ChapitreController;
use App\Models\Chapitre;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatiereController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Routes API pour les matières avec préfixe /api
Route::apiResource('matieres', MatiereController::class);
Route::apiResource('chapitres', ChapitreController::class);
Route::get('/matieres/{matiere}/chapitres', function ($matiere) {
    return Chapitre::where('matiere_id', $matiere)->get();
});

