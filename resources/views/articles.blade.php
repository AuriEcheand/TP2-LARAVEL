<!-- get the navigation.blade -->
@include('layouts.navigation')



<a href="{{ route('nouvelArticle') }}" class="btn btn-primary mt-2 mb-2">Ajouter un Article</a>
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>Titre</th>
            <th>Date de publication</th>
            <th>Langue</th>
            <th>Auteur</th>
            <th>Afficher</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->titre }}</td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->langue}}</td>
                <td>{{ $article->user->name }}</td>
                <td><a href="{{ route('articles.show', $article->id) }}">Afficher</a></td>
                <!-- if connected you can modify your articles -->
                @if (Auth::check() && Auth::user()->id == $article->user_id)
                    <td><a href="{{ route('articles.edit', $article->id) }}">Modifier</a></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>