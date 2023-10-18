<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ville;
use Illuminate\Support\Facades\Auth;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = DB::table('etudiants')->get();

        return view('etudiants', ['etudiants' => $etudiants]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::all();
        return view('nouvelEtudiant', compact('villes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:etudiants|max:255',
            'date_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id',
        ]);
    
        $validated['user_id'] = Auth::id();
    
        Etudiant::create($validated);

        return redirect()->route('etudiants')->with('success', 'Etudiant créé avec succès.');
    }
     


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('unEtudiant', compact('etudiant'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('etudiantEdit', compact('etudiant'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:etudiants,email,' . $id . '|max:255',
            'date_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id',
        ]);

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->update($validated);

        return redirect()->route('etudiants.edit', $etudiant->id)->with('succès', 'Etudiant modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('etudiants')
            ->with('succès', 'Etudiant supprimé avec succès');
    }
}
