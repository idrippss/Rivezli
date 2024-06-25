<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Tableau de Bord</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Matières</h5>
                        <p class="card-text">{{ $stats['matieres'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Chapitres</h5>
                        <p class="card-text">{{ $stats['chapitres'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Utilisateurs</h5>
                        <p class="card-text">{{ $stats['users'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Cours Générés</h5>
                        <p class="card-text">{{ $stats['cours'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Exercices Générés</h5>
                        <p class="card-text">{{ $stats['exercices'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">TD Générés</h5>
                        <p class="card-text">{{ $stats['td'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h5 class="card-title">TP Générés</h5>
                        <p class="card-text">{{ $stats['tp'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Examens Générés</h5>
                        <p class="card-text">{{ $stats['examens'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
