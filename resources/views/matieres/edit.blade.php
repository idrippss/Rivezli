<!-- resources/views/matieres/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Éditer Matière</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('matieres.update', $matiere->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $matiere->nom) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="langue">Langue</label>
                        <select class="form-control" id="langue" name="langue" required>
                            <option value="">Sélectionner une langue</option>
                            <option value="francais" {{ old('langue', $matiere->langue) == 'francais' ? 'selected' : '' }}>Français</option>
                            <option value="anglais" {{ old
