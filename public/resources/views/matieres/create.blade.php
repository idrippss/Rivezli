<!-- resources/views/matieres/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Ajouter une Matière</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('matieres.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="langue">Langue</label>
                        <select class="form-control" id="langue" name="langue" required>
                            <option value="">Sélectionner une langue</option>
                            <option value="francais" {{ old('langue') == 'francais' ? 'selected' : '' }}>Français</option>
                            <option value="anglais" {{ old('langue') == 'anglais' ? 'selected' : '' }}>Anglais</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
                    <a href="{{ route('matieres.index') }}" class="btn btn-secondary mt-3">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection
