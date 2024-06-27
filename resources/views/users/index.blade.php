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

    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>

@section('content')
    <div class="container mt-5">
        <!-- Bouton Ajouter un Administrateur -->
        <div class="row mb-4">
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal">
                    Ajouter un Administrateur
                </button>
            </div>
        </div>

        <!-- Bloc de statistiques -->
        <div class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Utilisateurs</h5>
                            <p class="card-text">{{ $stats['total_users'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">Administrateurs</h5>
                            <p class="card-text">{{ $stats['admin_count'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stats-card">
                        <div class="card-body">
                            <h5 class="card-title">Utilisateurs</h5>
                            <p class="card-text">{{ $stats['user_count'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire de filtrage -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-3 filter-form">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Recherche" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-control">
                        <option value="">Sélectionner le rôle</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </div>
        </form>

        <!-- Liste des utilisateurs -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Ressources Générées</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->exercises_count }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal pour ajouter un administrateur -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Ajouter un Administrateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('users.storeAdmin') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
