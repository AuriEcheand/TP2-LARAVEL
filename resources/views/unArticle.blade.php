@include('layouts.navigation')

<div class="container mt-4 bg-dark text-light p-4">
    <h1 class="mb-4">Information sur l'article</h1>
    <div class='card bg-dark text-light p-4'>
        <div>
            <label for="titre" class="text-light">Titre :</label>
            <p>{{ $article->titre }}</p>
        </div>

        <div>
            <label for="contenu" class="text-light">Contenu :</label>
            <p>{{ $article->contenu }}</p>
        </div>

        <div>
            <label for="langue" class="text-light">Langue :</label>
            <p>{{ $article->langue }}</p>
        </div>

        <div>
            <label for="user" class="text-light">Auteur :</label>
            <p>{{ $article->user->name }}</p>
        </div>

        <div>
            <label for="date" class="text-light">Date de publication :</label>
            <p>{{ $article->created_at }}</p>
        </div>

        @if (Auth::check() && Auth::user()->id == $article->user_id)
        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-info">Modifier</a>
        @endif

    </div>

    @if (Auth::check() && Auth::user()->id == $article->user_id)
    <form class="form-delete" method="POST" action="{{ route('articles.destroy', $article->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
    @endif

</div>