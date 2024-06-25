<!-- resources/views/ia-generate/result.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Résultat de la Génération IA</h2>

                <p><strong>Matière :</strong> {{ $matiere }}</p>
                <p><strong>Chapitre :</strong> {{ $chapitre }}</p>
                <p><strong>Type :</strong> {{ $type }}</p>
                <p><strong>Prompt :</strong> {{ $prompt }}</p>
                <p><strong>Difficulté :</strong> {{ $difficulty }}</p>
                <p><strong>Résultat :</strong> {!! nl2br(e($result)) !!}</p>

                <a href="{{ route('ia-generate.index') }}" class="btn btn-primary mt-3">Retour</a>
            </div>
        </div>
    </div>
@endsection
