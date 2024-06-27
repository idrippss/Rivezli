<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Chapitre;
use App\Models\User;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $stats = [
                'matieres' => Matiere::count(),
                'chapitres' => Chapitre::count(),
                'users' => User::count(),
                'cours' => Exercise::where('type', 'cours')->count(),
                'exercices' => Exercise::where('type', 'exercice')->count(),
                'td' => Exercise::where('type', 'td')->count(),
                'tp' => Exercise::where('type', 'tp')->count(),
                'examens' => Exercise::where('type', 'examen')->count(),
            ];

            $matieres = Matiere::all();
            $matiereStats = [];

            foreach ($matieres as $matiere) {
                $matiereStats[] = [
                    'nom' => $matiere->nom,
                    'total' => Exercise::where('matiere', $matiere->nom)->count()
                ];
            }
        } else {
            $user = Auth::user();
            $stats = [
                'cours' => Exercise::where('user_id', $user->id)->where('type', 'cours')->count(),
                'exercices' => Exercise::where('user_id', $user->id)->where('type', 'exercice')->count(),
                'td' => Exercise::where('user_id', $user->id)->where('type', 'td')->count(),
                'tp' => Exercise::where('user_id', $user->id)->where('type', 'tp')->count(),
                'examens' => Exercise::where('user_id', $user->id)->where('type', 'examen')->count(),
            ];
            $matiereStats = [];
        }

        return view('dashboard.index', compact('stats', 'matiereStats'));
    }
}
