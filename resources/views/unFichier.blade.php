@include('layouts.navigation')

<div class="container mt-4 bg-dark text-light p-4">
    <h1 class="mb-4 text-light">Information sur le fichier</h1>
    <div class="card bg-dark text-light p-4">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <p class="form-control">{{ $fichier->titre }}</p>
        </div>

        <div class="mb-3">
            <label for="langue" class="form-label">Langue</label>
            <p class="form-control">{{ $fichier->langue }}</p>
        </div>

        <div class="mb-3">
            <label for="user" class="form-label">Auteur</label>
            <p class="form-control">{{ $fichier->user->name }}</p>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date de publication</label>
            <p class="form-control">{{ $fichier->created_at }}</p>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Fichier</label>
            <a href="{{ asset('storage/uploads/'.$fichier->file) }}" class="btn btn-primary">Télécharger</a>
        </div>

        @if (Auth::check() && Auth::user()->id == $fichier->user_id)
        <a href="{{ route('fichiers.edit', $fichier->id) }}" class="btn btn-info">Modifier</a>
        @endif
    </div>

    @if (Auth::check() && Auth::user()->id == $fichier->user_id)
    <form class="form-delete" method="POST" action="{{ route('fichiers.destroy', $fichier->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    @endif
</div>