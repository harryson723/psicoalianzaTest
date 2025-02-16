@foreach ($paginatedDrinks as $coctel)
    <x-cocktail-card :coctel="$coctel" :isDB="$isDB ?? false" />
@endforeach

@if ($nextPage)
    <div class="col-span-full text-center">
        <x-common.button id="load-more" data-next-page="{{ $nextPage }}">
            Cargar más
        </x-common.button>
    </div>
@endif
<script src="{{ asset('assets/js/cocktails/getCocktailDetail.js') }}"></script>
<script src="{{ asset('assets/js/cocktails/cocktailDB.js') }}"></script>
