@include('layouts.navigation')

    <div class="container">
        <h1>Ajouter un étudiant</h1>
        <form action="{{ route('etudiants.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="tel" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ville_id">Ville</label>
                <select name="ville_id" id="ville_id" class="form-control">
                    @foreach(\App\Models\Ville::all() as $ville)
                        <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
        </form>
    </div>
