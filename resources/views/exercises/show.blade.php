<!-- resources/views/exercises/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-3">Exercice</h2>
                    <div>
                        <!-- Bouton pour ouvrir le modal Améliorer -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#improveModal">
                            Améliorer la génération
                        </button>
                        @if ($exercise->type == 'exercice')
                            <!-- Bouton pour ouvrir le modal Corriger -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#correctModal">
                                Corriger l'exercice
                            </button>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Matière :</strong> {{ $exercise->matiere }}
                </div>
                <div class="mb-3">
                    <strong>Chapitre :</strong> {{ $exercise->chapitre }}
                </div>
                <div class="mb-3">
                    <strong>Type :</strong> {{ ucfirst($exercise->type) }}
                </div>
                <div class="mb-3">
                    <strong>Niveau de difficulté :</strong> {{ ucfirst($exercise->difficulty) }}
                </div>
                <div class="mb-3">
                    <strong>Contenu :</strong>
                    <pre>{{ $exercise->content }}</pre>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>

    <!-- Modal pour améliorer la génération -->
    <div class="modal fade" id="improveModal" tabindex="-1" aria-labelledby="improveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('exercises.improve', $exercise->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="improveModalLabel">Améliorer la génération</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="prompt">Écrire un prompt pour améliorer la génération :</label>
                            <input type="text" class="form-control" id="prompt" name="prompt" placeholder="Écrire un prompt" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Améliorer la génération</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal pour corriger l'exercice -->
    @if ($exercise->type == 'exercice')
        <div class="modal fade" id="correctModal" tabindex="-1" aria-labelledby="correctModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('exercises.correct', $exercise->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="correctModalLabel">Corriger l'exercice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="correctionPrompt">Instructions pour corriger l'exercice :</label>
                                <input type="text" class="form-control" id="correctionPrompt" name="correctionPrompt" placeholder="Écrire des instructions pour corriger" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Corriger l'exercice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <!-- Ajouter les scripts Bootstrap pour les modals -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
