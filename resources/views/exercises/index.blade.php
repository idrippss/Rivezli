<!-- resources/views/exercises/index.blade.php -->
@extends('layouts.app')

<style>

    .card {
        transition: transform 0.2s, box-shadow 0.2s;
        border-radius: 10px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .stats-card {
        background: #f8f9fa;
        border: none;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .stats-card .card-body {
        padding: 10px;
    }

    .stats-card .card-title {
        font-size: 18px;
        font-weight: 700;
    }

    .stats-card .card-text {
        font-size: 24px;
        font-weight: 700;
        color: #007bff;
    }

    .filter-form .form-control,
    .filter-form .btn {
        border-radius: 5px;
        margin-bottom: 10px;
    }

</style>

@section('content')
    <div class="container mt-5">
        <h2 class="mb-3">Liste des Exercices</h2>

        <!-- Bloc de statistiques -->
        <div class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">Total</h5>
                            <p class="card-text">{{ $stats['total'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">Cours</h5>
                            <p class="card-text">{{ $stats['cours'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">Exercices</h5>
                            <p class="card-text">{{ $stats['exercice'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">TD</h5>
                            <p class="card-text">{{ $stats['td'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">TP</h5>
                            <p class="card-text">{{ $stats['tp'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">Examens</h5>
                            <p class="card-text">{{ $stats['examen'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire de filtrage -->
        <form method="GET" action="{{ route('exercices.index') }}" class="mb-3 filter-form">
            <div class="row g-2">
                <div class="col-md-2">
                    <input type="text" name="search" class="form-control" placeholder="Recherche" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-control">
                        <option value="">Sélectionner le type</option>
                        <option value="cours" {{ request('type') == 'cours' ? 'selected' : '' }}>Cours</option>
                        <option value="exercice" {{ request('type') == 'exercice' ? 'selected' : '' }}>Exercice</option>
                        <option value="td" {{ request('type') == 'td' ? 'selected' : '' }}>TD</option>
                        <option value="tp" {{ request('type') == 'tp' ? 'selected' : '' }}>TP</option>
                        <option value="examen" {{ request('type') == 'examen' ? 'selected' : '' }}>Examen</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="matiere_id" class="form-control">
                        <option value="">Sélectionner la matière</option>
                        @foreach($matieres as $matiere)
                            <option value="{{ $matiere->id }}" {{ request('matiere_id') == $matiere->id ? 'selected' : '' }}>{{ $matiere->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="difficulty" class="form-control">
                        <option value="">Sélectionner la difficulté</option>
                        <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>Facile</option>
                        <option value="medium" {{ request('difficulty') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                        <option value="hard" {{ request('difficulty') == 'hard' ? 'selected' : '' }}>Difficile</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </div>
        </form>

        <!-- Liste des exercices -->
        <div class="row g-4">
            @foreach ($exercices as $exercise)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/' . $exercise->type . '.jpg') }}" class="card-img-top" alt="{{ $exercise->type }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $exercise->matiere }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $exercise->chapitre }}</h6>
                            <p class="card-text"><strong>Type :</strong> {{ ucfirst($exercise->type) }}</p>
                            <p class="card-text"><strong>Difficulté :</strong> {{ ucfirst($exercise->difficulty) }}</p>
                            <p class="card-text"><strong>Visibilité :</strong> {{ ucfirst($exercise->visibility) }}</p>
                            <a href="{{ route('exercice.show', $exercise->id) }}" class="btn btn-primary">Voir le détail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
