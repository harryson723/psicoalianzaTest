@props(['coctel', 'isDB' => false])

<div class="flex flex-col items-center cocktail-card-wrapper bg-white dark:bg-gray-900 shadow-md rounded-xl p-4 w-full h-full max-w-xs min-h-[450px]"
    data-id="{{ $coctel['idDrink'] }}">
    <p class="loading-message mt-1 text-sm text-gray-600 dark:text-gray-400">Cargando cóctel...</p>

    <div class="hidden card-container w-full text-center" id="card-{{ $coctel['idDrink'] }}">
        <div class="w-full h-60 overflow-hidden rounded-lg">
            <img src="{{ $coctel['strDrinkThumb'] }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="mb-5 gap-5 flex items-baseline justify-between max-sm:flex-col">
            <h3 class="text-left mt-8 text-lg font-semibold text-gray-900 dark:text-gray-100">
                @if ($isDB)
                    <input type="text" value="{{ $coctel['strDrink'] }}" class="bg-transparent border-none w-full"
                        onchange="updateCocktail('{{ $coctel['idDrink'] }}', 'title', this.value)">
                @else
                    {{ $coctel['strDrink'] }}
                @endif
            </h3>

            @if (!$isDB)
                <x-common.button
                    onclick="addCocktailToDB({{ $coctel['idDrink'] }}, '{{ addslashes($coctel['strDrink']) }}', '{{ $coctel['strDrinkThumb'] }}', '{{ addslashes(Auth::user()->email) }}')">
                    Agregar
                </x-common.button>
            @else
                <x-common.button class="bg-red-800 hover:bg-red-700 focus:bg-red-700 active:bg-red-800 text-white"
                    onclick="deleteCocktailDB('{{ $coctel['idDrink'] }}')">
                    Eliminar
                </x-common.button>
            @endif
        </div>

        <div
            class="text-left cocktail-details mt-2 text-sm text-gray-700 dark:text-gray-300 max-h-[200px] overflow-y-auto">
            <p class="cocktail-glass"><strong>Vaso recomendado:</strong>
                @if ($isDB)
                    <input type="text" value="{{ $coctel['strGlass'] ?? '' }}"
                        class="bg-transparent border-none w-full"
                        onchange="updateCocktail('{{ $coctel['idDrink'] }}', 'glass', this.value)">
                @else
                    {{ $coctel['strGlass'] ?? '' }}
                @endif
            </p>
            <p class="cocktail-description"><strong>Instrucciones:</strong>
                @if ($isDB)
                    <textarea class="bg-transparent border-none w-full"
                        onchange="updateCocktail('{{ $coctel['idDrink'] }}', 'description', this.value)">{{ $coctel['strInstructions'] ?? 'No hay instrucciones disponibles.' }}</textarea>
                @else
                    {{ $coctel['strInstructions'] ?? 'No hay instrucciones disponibles.' }}
                @endif
            </p>
        </div>

        @if ($isDB)
            <!-- Inputs ocultos -->
            <input type="hidden" name="id" value="{{ $coctel['idDrink'] }}">
            <input type="hidden" name="image" value="{{ $coctel['strDrinkThumb'] }}">
        @endif
    </div>
</div>
