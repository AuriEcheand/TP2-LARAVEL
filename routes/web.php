<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\EtudiantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('accueil');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // routes fichiers
    Route::get('/fichiers', [FichierController::class, 'index'])->name('fichiers');
    Route::post('/fichiers', [FichierController::class, 'store'])->name('fichiers.store');
    Route::get('/nouveauFichier', [FichierController::class, 'create'])->name('nouveauFichier');
    Route::get('/fichiers/{id}', [FichierController::class, 'show'])->name('fichiers.show');
    Route::get('/fichiers/{id}/edit', [FichierController::class, 'edit'])->name('fichiers.edit');
    Route::put('/fichiers/{id}', [FichierController::class, 'update'])->name('fichiers.update');
    Route::delete('/fichiers/{id}', [FichierController::class, 'destroy'])->name('fichiers.destroy');

    // routes etudiants
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants');
    Route::get('/etudiants/{id}', [EtudiantController::class, 'show'])->name('etudiants.show');
    Route::get('/nouvelEtudiant', [EtudiantController::class, 'create'])->name('nouvelEtudiant');
    Route::get('/etudiants/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::put('/etudiants/{id}', [EtudiantController::class, 'update'])->name('etudiants.update');
    Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
    Route::delete('/etudiants/{id}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
    
    // routes articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/nouvelArticle', [ArticleController::class, 'create'])->name('nouvelArticle');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

});

require __DIR__.'/auth.php';