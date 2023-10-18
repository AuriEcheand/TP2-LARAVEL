<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FichierController extends Controller
{
    /**
     * Affiche la liste de tous les fichiers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichiers = DB::table('fichiers')->get();

        // get the user who created the file
        foreach ($fichiers as $fichier) {
            $fichier->user = DB::table('users')->where('id', $fichier->user_id)->first();
        }

        return view('fichiers', compact('fichiers'));
    }

    /**
     * Affiche le formulaire pour créer un nouveau fichier.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nouveauFichier');
    }

    /**
     * Enregistre un nouveau fichier dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,zip,doc|max:2048',
            'langue' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['date_de_creation'] = now()->format('Y-m-d');

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $filename, 'public');

        $validated['file'] = $filename;

        Fichier::create($validated);

        return redirect()->route('fichiers')->with('success', 'Fichier ajouté avec succès.');
    }


    /**
     * Affiche un fichier spécifié.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fichier = Fichier::find($id);
        return view('unFichier', compact('fichier'));
    }

    /**
     * Affiche le formulaire pour éditer un fichier spécifié.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fichier = Fichier::find($id);
        return view('fichierEdit', compact('fichier'));
    }

    /**
     * Met à jour le fichier spécifié dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf,zip,doc|max:2048',
            'langue' => 'required|string',
        ]);

        $fichier = Fichier::find($id);

        $fichier->titre = $validated['titre'];
        $fichier->langue = $validated['langue'];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename, 'public');

            $fichier->file = $filename;
        }

        $fichier->save();

        return redirect()->route('fichiers.edit', $id)->with('success', 'Fichier modifié avec succès.');
    }

    /**
     * Supprime le fichier spécifié de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $fichier = Fichier::find($id);
        $fichier->delete();

        return redirect()->route('fichiers')->with('success', 'Fichier supprimé avec succès.');
    }
}
