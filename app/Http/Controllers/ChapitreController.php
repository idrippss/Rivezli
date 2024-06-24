<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Matiere;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    public function index()
    {
        $chapitres = Chapitre::all();
        return view('chapitres.index', compact('chapitres'));
    }

    public function create()
    {
        $matieres = Matiere::all();
        return view('chapitres.create', compact('matieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matiere_id' => 'required|exists:matieres,id',
            'nom' => 'required|string|max:255',
            'objectifs' => 'required|array',
            'objectifs.*' => 'required|string',
            'description' => 'required|string',
        ]);

        $chapitre = new Chapitre();
        $chapitre->matiere_id = $request->matiere_id;
        $chapitre->nom = $request->nom;
        $chapitre->objectif = json_encode($request->objectifs);
        $chapitre->description = $request->description;
        $chapitre->save();

        return redirect()->route('chapitres.index')->with('success', 'Chapitre ajouté avec succès.');
    }



    public function edit(Chapitre $chapitre)
    {
        $matieres = Matiere::all();
        return view('chapitres.edit', compact('chapitre', 'matieres'));
    }

    public function update(Request $request, Chapitre $chapitre)
    {
        $request->validate([
            'matiere_id' => 'required|exists:matieres,id',
            'nom' => 'required|string|max:255',
            'objectifs' => 'required|array',
            'objectifs.*' => 'required|string',
            'description' => 'required|string',
        ]);

        $chapitre->matiere_id = $request->matiere_id;
        $chapitre->nom = $request->nom;
        $chapitre->objectif = json_encode($request->objectifs);
        $chapitre->description = $request->description;
        $chapitre->save();

        return redirect()->route('chapitres.index')->with('success', 'Chapitre mis à jour avec succès.');
    }

    public function destroy(Chapitre $chapitre)
    {
        $chapitre->delete();

        return redirect()->route('chapitres.index')->with('success', 'Chapitre supprimé avec succès.');
    }
}
