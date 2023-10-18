@include('layouts.navigation')

<div class="container">
    <h1>Ajouter un fichier</h1>
    <form action="{{ route('fichiers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre">
        </div>
    
        <div class="form-group">
            <label for="file">Fichier à télécharger</label>
            <input type="file" class="form-control-file" id="file" name="file">
        </div>
    
        <div class="form-group">
            <label for="langue">Langue</label>
            <select name="langue" id="langue" class="form-control">
                <option value="français">Français</option>
                <option value="anglais">Anglais</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
    </form>
    </div>
