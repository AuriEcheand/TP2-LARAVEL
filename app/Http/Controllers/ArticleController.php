<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Affiche la liste de tous les articles du forum.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = DB::table('articles')->get();

        // get the user who created the article
        foreach ($articles as $article) {
            $article->user = DB::table('users')->where('id', $article->user_id)->first();
        }

        return view('articles', compact('articles'));

    }

    /**
     * Affiche le formulaire pour créer un nouvel article du forum.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nouvelArticle');
    }

    /**
     * Enregistre un nouvel article du forum dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'langue' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        Article::create($validated);

        return redirect()->route('articles')->with('success', 'Article créé avec succès.');
    }

    /**
     * Affiche un article du forum spécifié.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('unArticle', compact('article'));
    }

    /**
     * Affiche le formulaire pour éditer un article du forum spécifié.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articleEdit', compact('article'));
    }

    /**
     * Met à jour l'article du forum spécifié dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'langue' => 'required|string',
        ]);

        $article = Article::find($id);
        $article->titre = $validated['titre'];
        $article->contenu = $validated['contenu'];
        $article->langue = $validated['langue'];
        $article->save();

        return redirect()->route('articles.edit', $id)->with('success', 'Article modifié avec succès.');
    }

    /**
     * Supprime l'article du forum spécifié de la base de données.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('articles')->with('success', 'Article supprimé avec succès.');
    }
}
