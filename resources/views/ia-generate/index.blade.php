<!-- resources/views/ia-generate/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Générer du Contenu IA</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ia-generate.generate') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="matiere_id">Matière</label>
                        <select class="form-control" id="matiere_id" name="matiere_id" required>
                            <option value="">Sélectionner une matière</option>
                            @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>{{ $matiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="chapitre_id">Chapitre</label>
                        <select class="form-control" id="chapitre_id" name="chapitre_id" required>
                            <option value="">Sélectionner un chapitre</option>
                            <!-- Les chapitres seront chargés dynamiquement avec JavaScript -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Type de Génération</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="cours" {{ old('type') == 'cours' ? 'selected' : '' }}>Cours</option>
                            <option value="exercice" {{ old('type') == 'exercice' ? 'selected' : '' }}>Exercice</option>
                            <option value="td" {{ old('type') == 'td' ? 'selected' : '' }}>TD</option>
                            <option value="examen" {{ old('type') == 'examen' ? 'selected' : '' }}>Examen</option>
                            <option value="tp" {{ old('type') == 'tp' ? 'selected' : '' }}>TP</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="difficulty">Difficulté</label>
                        <select class="form-control" id="difficulty" name="difficulty" required>
                            <option value="">Sélectionner une difficulté</option>
                            <option value="easy" {{ old('difficulty') == 'easy' ? 'selected' : '' }}>Facile</option>
                            <option value="medium" {{ old('difficulty') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                            <option value="hard" {{ old('difficulty') == 'hard' ? 'selected' : '' }}>Difficile</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Générer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var matiereSelect = document.getElementById('matiere_id');
            var chapitreSelect = document.getElementById('chapitre_id');

            matiereSelect.addEventListener('change', function() {
                var matiereId = this.value;
                chapitreSelect.innerHTML = '<option value="">Sélectionner un chapitre</option>';

                if (matiereId) {
                    fetch(`/api/matieres/${matiereId}/chapitres`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(chapitre => {
                                var option = document.createElement('option');
                                option.value = chapitre.id;
                                option.text = chapitre.nom;
                                chapitreSelect.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>
@endsection
