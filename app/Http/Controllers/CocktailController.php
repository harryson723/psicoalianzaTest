<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CocktailController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 9;

        // Obtener los cócteles paginados desde la base de datos
        $cocktails = Cocktail::paginate($perPage, ['*'], 'page', $page);

        // Transformar los datos para que coincidan con la API externa
        $formattedCocktails = $cocktails->map(function ($cocktail) {
            return [
                'idDrink' => $cocktail->id,
                'strDrink' => $cocktail->title,
                'strDrinkThumb' => $cocktail->image,
                'strInstructions' => $cocktail->description,
                'strGlass' => $cocktail->glass
            ];
        });

        // Determinar si hay más páginas
        $nextPage = $cocktails->hasMorePages() ? $page + 1 : null;

        // Retornar la vista parcial con los datos paginados
        return view('dashboard.partials.cocktail-cards', [
            'paginatedDrinks' => $formattedCocktails,
            'nextPage' => $nextPage,
            'isDB' => true,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id' => 'nullable|string|unique:cocktails,id|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:2048',
            'description' => 'nullable|string',
            'glass' => 'nullable|string|max:100',
        ]);

        $cocktail = Cocktail::create([
            'id' => $request->id ?? Str::uuid()->toString(), // Usa el ID dado o genera uno
            'title' => $request->title,
            'image' => $request->image,
            'description' => $request->description,
            'glass' => $request->glass,
        ]);

        return response()->json([
            'message' => 'Cóctel creado con éxito.',
            'cocktail' => $cocktail
        ], 201);
    }

    public function show(Cocktail $cocktail)
    {
        return response()->json($cocktail, 200);
    }

    public function update(Request $request, Cocktail $cocktail)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:2048',
            'description' => 'nullable|string',
            'glass' => 'nullable|string|max:100',
        ]);

        $cocktail->update($request->only(['title', 'description', 'image', 'glass']));

        return response()->json([
            'message' => 'Cóctel actualizado con éxito.',
            'cocktail' => $cocktail
        ], 200);
    }

    public function destroy($id)
    {
        $cocktail = Cocktail::find($id);

        if (!$cocktail) {
            return response()->json(['message' => 'Cóctel no encontrado.'], 404);
        }

        $cocktail->delete();

        return response()->json(['message' => 'Cóctel eliminado con éxito.'], 200);
    }

}
