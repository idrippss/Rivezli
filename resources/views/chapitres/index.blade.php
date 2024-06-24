<!-- resources/views/chapitres/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0">Chapitres</h2>
                    <a href="{{ route('chapitres.create') }}" class="btn btn-primary">Ajouter un nouveau Chapitre</a>
                </div>

                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Matière</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($chapitres as $chapitre)
                        <tr>
                            <td>{{ $chapitre->id }}</td>
                            <td>{{ $chapitre->nom }}</td>
                            <td>{{ $chapitre->matiere->nom }}</td>
                            <td>
                                <a href="{{ route('chapitres.edit', $chapitre->id) }}" class="btn btn-sm btn-warning">Éditer</a>
                                <form action="{{ route('chapitres.destroy', $chapitre->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce chapitre ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
