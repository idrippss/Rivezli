<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;

class ExerciseController extends Controller
{
    protected $openai;

    public function __construct()
    {
        $this->openai = OpenAI::client(config('services.openai.api_key'));
    }

    public function index(Request $request)
    {
        $matieres = Matiere::all();
        $exercices = Exercise::query();

        // Filtrer par type si spécifié
        if ($request->filled('type')) {
            $exercices->where('type', $request->input('type'));
        }

        // Filtrer par matière si spécifié
        if ($request->filled('matiere_id')) {
            $matiere = Matiere::find($request->input('matiere_id'));
            $exercices->where('matiere', $matiere->nom);
        }

        // Filtrer par difficulté si spécifié
        if ($request->filled('difficulty')) {
            $exercices->where('difficulty', $request->input('difficulty'));
        }

        // Filtrer par recherche si spécifié
        if ($request->filled('search')) {
            $search = $request->input('search');
            $exercices->where(function($query) use ($search) {
                $query->where('content', 'like', "%$search%")
                    ->orWhere('matiere', 'like', "%$search%")
                    ->orWhere('chapitre', 'like', "%$search%");
            });
        }

        // Filtrer par visibilité
        $exercices->where(function($query) {
            $query->where('visibility', 'public')
                ->orWhere(function($query) {
                    $query->where('user_id', Auth::id())
                        ->where('visibility', 'private');
                });
        });

        $exercices = $exercices->get();

        $stats = [
            'total' => $exercices->count(),
            'cours' => $exercices->where('type', 'cours')->count(),
            'exercice' => $exercices->where('type', 'exercice')->count(),
            'td' => $exercices->where('type', 'td')->count(),
            'tp' => $exercices->where('type', 'tp')->count(),
            'examen' => $exercices->where('type', 'examen')->count(),
        ];

        return view('exercises.index', compact('exercices', 'matieres', 'stats'));
    }

    public function show($id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('exercises.show', compact('exercise'));
    }

    public function improve(Request $request, Exercise $exercise)
    {
        $request->validate([
            'prompt' => 'required|string|max:255',
        ]);

        $prompt = $request->input('prompt');
        $fullPrompt = "
        Matière: {$exercise->matiere}
        Chapitre: {$exercise->chapitre}
        Type de contenu: {$exercise->type} (cours, exercice, TD, TP, examen)
        Niveau de difficulté: {$exercise->difficulty}

        Contenu original:
        {$exercise->content}

        Instructions spécifiques:
        - Améliorer le contenu ci-dessus en suivant les indications supplémentaires ci-dessous.
        - $prompt
        ";

        // Appeler l'API OpenAI pour le modèle GPT-4
        $response = $this->openai->chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a university professor assistant.'],
                ['role' => 'user', 'content' => $fullPrompt],
            ],
        ]);

        $improvedContent = $response['choices'][0]['message']['content'];

        return redirect()->route('exercises.compare', ['exercise' => $exercise->id, 'newContent' => $improvedContent]);
    }


    public function compare(Request $request, $id)
    {
        $exercise = Exercise::findOrFail($id);
        $newContent = $request->query('newContent');

        $outputBuilder = new UnifiedDiffOutputBuilder("--- Original\n+++ New\n", false);
        $differ = new Differ($outputBuilder);
        $diffs = $differ->diffToArray($exercise->content, $newContent);

        $hasDifferences = false;
        foreach ($diffs as $diff) {
            if ($diff[1] !== 0) {
                $hasDifferences = true;
                break;
            }
        }

        return view('exercises.compare', [
            'exercise' => $exercise,
            'newContent' => $newContent,
            'diffs' => $diffs,
            'hasDifferences' => $hasDifferences,
        ]);
    }

    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $exercise->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('exercice.show', $exercise->id)->with('success', 'Contenu mis à jour avec succès.');
    }
}
