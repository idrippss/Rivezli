@extends('layouts.app')
<style>

    .diff-insert {
        background-color: #e6ffed;
    }
    .diff-delete {
        background-color: #ffeef0;
        text-decoration: line-through;
    }

</style>
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Comparer les versions</h2>
            <form action="{{ route('exercises.update', $exercise->id) }}" method="POST" class="d-flex align-items-center">
                @csrf
                @method('PUT')
                <input type="hidden" name="content" value="{{ $newContent }}">
                <button type="submit" class="btn btn-success mr-2">Accepter la nouvelle version</button>
                <a href="{{ route('exercice.show', $exercise->id) }}" class="btn btn-secondary">Retour à l'exercice</a>
            </form>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ancien Contenu</h5>
                        <pre id="old-content">{{ $exercise->content }}</pre>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nouveau Contenu</h5>
                        <pre id="new-content">{{ $newContent }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
