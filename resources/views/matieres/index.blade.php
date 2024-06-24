<!-- resources/views/matieres/index.blade.php -->
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
                    <h2 class="mb-0">Matières</h2>
                    <a href="{{ route('matieres.create') }}" class="btn btn-primary">Ajouter une nouvelle Matière</a>
                </div>

                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Langue</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($matieres as $matiere)
                        <tr>
                            <td>{{ $matiere->id }}</td>
                            <td>{{ $matiere->nom }}</td>
                            <td>{{ $matiere->langue }}</td>
                            <td>
                                <a href="{{ route('matieres.edit', $matiere->id) }}" class="btn btn-sm btn-warning">Éditer</a>
                                <form action="{{ route('matieres.destroy', $matiere->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?')">Supprimer</button>
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
