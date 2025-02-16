@if ($paginatedDrinks->isEmpty())
    <p class="w-full col-span-full text-center text-gray-600 dark:text-gray-400">
        No se han agregado cócteles aun.
    </p>
@else
    @foreach ($paginatedDrinks as $coctel)
        <x-cocktail-card :coctel="$coctel" :isDB="$isDB ?? false" />
    @endforeach
@endif



@if ($nextPage)
    <div class="col-span-full text-center">
        <x-common.button id="load-more" data-next-page="{{ $nextPage }}">
            Cargar más
        </x-common.button>
    </div>
@endif
<script src="{{ asset('assets/js/cocktails/getCocktailDetail.js') }}"></script>
<script src="{{ asset('assets/js/cocktails/cocktailDB.js') }}"></script>
