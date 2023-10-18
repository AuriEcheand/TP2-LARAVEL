@include('layouts.navigation')

@php
$etudiant = \App\Models\Etudiant::where('user_id', auth()->user()->id)->first();
@endphp

@if (!$etudiant)
<a href="{{ route('nouvelEtudiant') }}" class="btn btn-primary mt-2 mb-2">Créer mon Profil Etudiant</a>
@endif

<table class="table table-striped ">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Adresse</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Modifier</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($etudiants as $etudiant)
        <tr>
            <td>{{ $etudiant->nom }}</td>
            <td>{{ $etudiant->adresse }}</td>
            <td>{{ $etudiant->phone }}</td>
            <td>{{ $etudiant->email }}</td>
            @if ($etudiant->user_id == auth()->user()->id)
            <td><a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-primary">Modifier</a></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>