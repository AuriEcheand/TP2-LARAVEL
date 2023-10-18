@include('layouts.navigation')

<div class="container mt-4">
    <h1 class="mb-4">Information sur le fichier</h1>

    <form method="POST" action="{{ route('fichiers.update', $fichier->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" value="{{ $fichier->titre }}">
    </div>

    <div class="form-group">
        <label for="file">Fichier</label>
        <input type="file" name="file" id="file" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="langue">Langue</label>
        <select name="langue" id="langue" class="form-control">
            <option value="français" {{ $fichier->langue == 'français' ? 'selected' : '' }}>Français</option>
            <option value="anglais" {{ $fichier->langue == 'anglais' ? 'selected' : '' }}>Anglais</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

<form class="form-delete mt-4" method="POST" action="{{ route('fichiers.destroy', $fichier->id) }}">
    @csrf
    @method('DELETE')

    <p>Êtes-vous sûr de vouloir supprimer ce fichier ?</p>
    <button type="submit" class="btn btn-danger">Supprimer</button>
</form>

</div>


