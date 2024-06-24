<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::all();
        return view('matieres.index', compact('matieres'));
    }

    public function create()
    {
        return view('matieres.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'langue' => 'required|string|max:255',
        ]);

        Matiere::create($validatedData);

        return redirect()->route('matieres.index')->with('success', 'Matière ajoutée avec succès.');
    }

    public function edit(Matiere $matiere)
    {
        return view('matieres.edit', compact('matiere'));
    }

    public function update(Request $request, Matiere $matiere)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'langue' => 'required|string|max:255',
        ]);

        $matiere->update($validatedData);

        return redirect()->route('matieres.index')->with('success', 'Matière mise à jour avec succès.');
    }

    public function destroy(Matiere $matiere)
    {
        $matiere->delete();

        return redirect()->route('matieres.index')->with('success', 'Matière supprimée avec succès.');
    }
}
