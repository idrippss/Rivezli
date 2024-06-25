<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Matiere;
use App\Models\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI;

class IAGenerateController extends Controller
{
    protected $openai;

    public function __construct()
    {
        $this->openai = OpenAI::client(config('services.openai.api_key'));
    }

    public function index()
    {
        $matieres = Matiere::all();
        return view('ia-generate.index', compact('matieres'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'matiere_id' => 'required|exists:matieres,id',
            'chapitre_id' => 'required|exists:chapitres,id',
            'type' => 'required|string|in:cours,exercice,td,examen,tp',
            'difficulty' => 'required|string|in:easy,medium,hard',
        ]);

        $matiere = Matiere::find($request->input('matiere_id'))->nom;
        $chapitre = Chapitre::find($request->input('chapitre_id'));
        $type = $request->input('type');
        $prompt = $request->input('prompt');
        $difficulty = $request->input('difficulty');

        // Récupérer les objectifs depuis la base de données
        $objectifs = json_decode($chapitre->objectif, true);
        $formattedObjectifs = "";
        foreach ($objectifs as $index => $objectif) {
            $formattedObjectifs .= "- Objectif " . ($index + 1) . ": " . $objectif . "\n";
        }

        // Instructions spécifiques selon le type de contenu
        $specificInstructions = "";
        switch ($type) {
            case 'cours':
                $specificInstructions = "
            - Le cours doit inclure une introduction claire, une explication détaillée des concepts clés, des exemples pertinents et des conclusions.
            - Inclure des références à des travaux académiques ou des manuels reconnus.
            - Utiliser des schémas, des diagrammes ou des illustrations pour appuyer les explications.
            - Prévoir des sections de questions/réponses pour vérifier la compréhension.
            ";
                break;
            case 'exercice':
                $specificInstructions = "
            - Fournir une série de questions variées (QCM, questions ouvertes, problèmes à résoudre) adaptées au niveau de difficulté.
            - Inclure des réponses détaillées et des explications pour chaque question.
            - Structurer les exercices en sections thématiques pour couvrir différents aspects du chapitre.
            ";
                break;
            case 'td':
                $specificInstructions = "
            - Inclure des activités pratiques qui permettent aux étudiants de mettre en application les concepts théoriques.
            - Fournir des instructions claires et détaillées pour chaque activité.
            - Inclure des objectifs spécifiques à atteindre et des critères d'évaluation.
            - Prévoir une section de discussion pour que les étudiants puissent partager leurs résultats et observations.
            ";
                break;
            case 'tp':
                $specificInstructions = "
            - Proposer des expériences ou des projets pratiques avec des étapes détaillées.
            - Inclure des instructions sur les matériels nécessaires et les procédures à suivre.
            - Fournir des objectifs spécifiques pour chaque étape et des critères d'évaluation.
            - Inclure des conseils pour la résolution des problèmes courants que les étudiants pourraient rencontrer.
            ";
                break;
            case 'examen':
                $specificInstructions = "
            - Proposer une variété de questions (QCM, questions ouvertes, problèmes à résoudre) couvrant l'ensemble du chapitre.
            - Fournir une grille de correction détaillée avec des critères spécifiques pour chaque question.
            - Inclure des questions de différents niveaux de difficulté pour évaluer la compréhension et les compétences des étudiants.
            - Assurer une bonne répartition des points pour chaque section de l'examen.
            ";
                break;
        }

        // Construire le prompt pour OpenAI
        $fullPrompt = "
    Matière: $matiere
    Chapitre: $chapitre->nom
    Type de contenu: $type (cours, exercice, TD, TP, examen)
    Niveau de difficulté: $difficulty (facile, moyen, difficile)

    Objectif de la matière:
    Fournir une compréhension approfondie de $matiere, couvrant les concepts clés suivants:
    $formattedObjectifs

    Instructions spécifiques:
    - Le contenu doit être structuré de manière professionnelle et adapté aux enseignants universitaires.
    - Le langage utilisé doit être académique et précis, évitant le jargon inutile.
    $specificInstructions

    Générez un contenu académique de haute qualité basé sur les informations ci-dessus. Le contenu doit être prêt à être utilisé par un enseignant universitaire pour la matière et le chapitre spécifiés, en respectant le type de contenu demandé et le niveau de difficulté indiqué.
    ";

        // Appeler l'API OpenAI pour le modèle GPT-4
        $response = $this->openai->chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a university professor assistant.'],
                ['role' => 'user', 'content' => $fullPrompt],
            ],
        ]);

        $result = $response['choices'][0]['message']['content'];


        // Stocker l'exercice dans la base de données
        $exercise = Exercise::create([
            'user_id' => Auth::id(),
            'matiere' => $matiere,
            'chapitre' => $chapitre->nom,
            'type' => $type,
            'difficulty' => $difficulty,
            'content' => $result,
        ]);

        // Rediriger vers la page de l'exercice créé
        return redirect()->route('exercice.show', $exercise->id);


    }





}
