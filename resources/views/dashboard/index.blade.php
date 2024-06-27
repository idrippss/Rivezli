<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Tableau de Bord</h2>
        <div class="row">
            @if (Auth::user()->role === 'admin')
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
            @endif
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

        @if (Auth::user()->role === 'admin')
            <!-- Section for the chart -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques Générales</h5>
                            <canvas id="statsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section for the resources chart by subject -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de Ressources Générées par Matière</h5>
                            <canvas id="resourcesBySubjectChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if (Auth::user()->role === 'admin')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Chart for general stats
                var ctx = document.getElementById('statsChart').getContext('2d');
                var statsChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Matières', 'Chapitres', 'Utilisateurs', 'Cours', 'Exercices', 'TD', 'TP', 'Examens'],
                        datasets: [{
                            label: 'Nombre',
                            data: [
                                {{ $stats['matieres'] }},
                                {{ $stats['chapitres'] }},
                                {{ $stats['users'] }},
                                {{ $stats['cours'] }},
                                {{ $stats['exercices'] }},
                                {{ $stats['td'] }},
                                {{ $stats['tp'] }},
                                {{ $stats['examens'] }}
                            ],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Chart for resources by subject
                var ctx2 = document.getElementById('resourcesBySubjectChart').getContext('2d');
                var resourcesBySubjectChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_column($matiereStats, 'nom')) !!},
                        datasets: [{
                            label: 'Ressources Générées',
                            data: {!! json_encode(array_column($matiereStats, 'total')) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endsection

@section('scripts')
@endsection
