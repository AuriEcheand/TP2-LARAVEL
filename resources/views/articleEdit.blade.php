@include('layouts.navigation')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0">Information sur l'article</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('articles.update', $article->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control" value="{{ $article->titre }}">
                        </div>

                        <div class="form-group">
                            <label for="contenu">Contenu</label>
                            <textarea name="contenu" id="contenu" class="form-control">{{ $article->contenu }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="langue">Langue</label>
                            <select name="langue" id="langue" class="form-control">
                                <option value="français" {{ $article->langue == 'français' ? 'selected' : '' }}>Français</option>
                                <option value="anglais" {{ $article->langue == 'anglais' ? 'selected' : '' }}>Anglais</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>

                    </form>
                    <!-- delete the article -->
                    <form class="form-delete mt-3" method="POST" action="{{ route('articles.destroy', $article->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>