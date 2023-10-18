@include('layouts.navigation')

    <div class="container">
        <h1>Ajouter un article</h1>
        <form action="{{ route('articles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" class="form-control" required></textarea>
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
