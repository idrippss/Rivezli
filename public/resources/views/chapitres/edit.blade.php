<!-- resources/views/chapitres/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Éditer Chapitre</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('chapitres.update', $chapitre->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="matiere_id">Matière</label>
                        <select class="form-control" id="matiere_id" name="matiere_id" required>
                            <option value="">Sélectionner une matière</option>
                            @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}" {{ $chapitre->matiere_id == $matiere->id ? 'selected' : '' }}>{{ $matiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $chapitre->nom) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Objectifs</label>
                        <div id="objectifs">
                            @foreach(json_decode($chapitre->objectif) as $objectif)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="objectifs[]" value="{{ $objectif }}" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-objectif">-</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-success add-objectif">Ajouter un Objectif</button>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ old('description', $chapitre->description) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                    <a href="{{ route('chapitres.index') }}" class="btn btn-secondary mt-3">Annuler</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.add-objectif').addEventListener('click', function() {
                var newObjectif = document.createElement('div');
                newObjectif.classList.add('input-group', 'mb-2');
                newObjectif.innerHTML = `
                <input type="text" class="form-control" name="objectifs[]" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-objectif">-</button>
                </div>
            `;
                document.getElementById('objectifs').appendChild(newObjectif);
            });

            document.getElementById('objectifs').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-objectif')) {
                    event.target.closest('.input-group').remove();
                }
            });
        });
    </script>
@endsection
