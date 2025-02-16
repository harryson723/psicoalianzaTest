<?php

use App\Http\Controllers\CocktailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mycocktails', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('mycocktails');

Route::get('/cocktails', function () {
    $category = request('category', 'Cocktail');
    $page = request('page', 1); // Página actual
    $perPage = 9; // Número de cócteles por página

    // Llamada a la API
    $response = Http::withoutVerifying()->get("https://www.thecocktaildb.com/api/json/v1/1/filter.php?c={$category}");
    $drinks = collect($response->json()['drinks'] ?? []);

    // Paginar manualmente
    $paginatedDrinks = $drinks->slice(($page - 1) * $perPage, $perPage)->values();

    // Verificar si hay más páginas
    $nextPage = count($paginatedDrinks) < $perPage ? null : $page + 1;

    // Retornar la vista parcial con los datos paginados
    return view('dashboard.partials.cocktail-cards', compact('paginatedDrinks', 'nextPage'));
})->middleware(['auth', 'verified'])->name('cocktails');
;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('api/cocktails', CocktailController::class)
    ->middleware(['auth', 'verified']);

    

require __DIR__ . '/auth.php';
