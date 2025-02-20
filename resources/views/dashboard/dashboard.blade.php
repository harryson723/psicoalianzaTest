<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto max-sm:px-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                <div class="cocktail-container p-6 text-gray-900 dark:text-gray-100">
                    <div id="cocktail-list" class="grid grid-cols-3 gap-4 max-sm:grid-cols-1 max-md:grid-cols-2 place-items-center">
                        <!-- Aquí se insertarán las cards dinámicamente -->
                    </div>                    
                    <p id="loading-message" class="text-center mt-4 text-gray-600 dark:text-gray-400 hidden">
                        Cargando más cócteles...
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('assets/js/cocktails/loadCocktails.js') }}"></script>
