@include('layouts.navigation')

<a href="{{ route('nouveauFichier') }}" class="btn btn-primary mt-2 mb-2">Ajouter un fichier</a>
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date de publication</th>
            <th>Afficher</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fichiers as $fichier)
            <tr>
                <td>{{ $fichier->titre }}</td>
                <td>{{ $fichier->user->name }}</td>
                <td>{{ $fichier->date_de_creation }}</td>
                <td><a href="{{ route('fichiers.show', $fichier->id) }}">Afficher</a></td>  
                <!-- if connected you can modify your files -->
                @if (Auth::check() && Auth::user()->id == $fichier->user_id)
                    <td><a href="{{ route('fichiers.edit', $fichier->id) }}">Modifier</a></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
