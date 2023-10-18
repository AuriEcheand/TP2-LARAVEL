@include('layouts.navigation')

<div class="container mt-4">
    <h1 class="mb-4">Information sur l'étudiant</h1>

    <form method="POST" action="{{ route('etudiants.update', $etudiant->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $etudiant->nom }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $etudiant->email }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $etudiant->phone }}">
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <textarea name="adresse" id="adresse" class="form-control">{{ $etudiant->adresse }}</textarea>
        </div>

        <div>
            <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{ $etudiant->date_naissance }}">
        </div>

        <div class="form-group">
            <label for="ville_id">Ville</label>
            <select name="ville_id" id="ville_id" class="form-control">
                @foreach(\App\Models\Ville::all() as $ville)
                <option value="{{ $ville->id }}" {{ $etudiant->ville_id == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>

    <form class="form-delete mt-4" method="POST" action="{{ route('etudiants.destroy', $etudiant->id) }}">
    @csrf
    @method('DELETE')

    <p>Êtes-vous sûr de vouloir supprimer votre profil etudiant ?</p>
    <button type="submit" class="btn btn-danger">Supprimer</button>
</form>
</div>


