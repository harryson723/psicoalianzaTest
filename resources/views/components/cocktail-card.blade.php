@props(['coctel', 'isDB' => false])

<div class="flex flex-col items-center cocktail-card-wrapper bg-white dark:bg-gray-900 shadow-md rounded-xl p-4 w-full max-w-xs"
    data-id="{{ $coctel['idDrink'] }}">
    <p class="loading-message mt-1 text-sm text-gray-600 dark:text-gray-400">Cargando cóctel...</p>

    <div class="hidden card-container w-full text-center" id="card-{{ $coctel['idDrink'] }}">
        <div class="w-full h-60 overflow-hidden rounded-lg">
            <img src="{{ $coctel['strDrinkThumb'] }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="mb-5 gap-5 flex items-baseline justify-between">
            <h3 class="text-left mt-8 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $coctel['strDrink'] }}
            </h3>
            @if (!$isDB)
                <x-common.button
                    onclick="addCocktailToDB({{ $coctel['idDrink'] }}, '{{ addslashes($coctel['strDrink']) }}', '{{ $coctel['strDrinkThumb'] }}', '{{ addslashes(Auth::user()->email) }}')">
                    Agregar
                </x-common.button>
            @else
                <x-common.button onclick="deleteCocktailDB('{{ $coctel['idDrink'] }}')" class="bg-red-600">
                    Eliminar
                </x-common.button>
            @endif

        </div>
        <div
            class="text-left cocktail-details mt-2 text-sm text-gray-700 dark:text-gray-300 max-h-[300px] overflow-y-auto">
            <p class="cocktail-glass"><strong>Vaso recomendado:</strong>
                {{ $coctel['strGlass'] ?? '' }}</p>
            <p class="cocktail-description"><strong>Instrucciones:</strong>
                {{ $coctel['strInstructions'] ?? 'No hay instrucciones disponibles.' }}</p>
        </div>
    </div>
</div>
