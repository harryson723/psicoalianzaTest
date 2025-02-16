$(document).ready(function () {
    let currentPage = 1;
    let isLoading = false;

    function loadCocktails(page) {
        if (isLoading) return;
        isLoading = true;
        $("#loading-message").removeClass("hidden");
        const { pathname } = window.location;
        const url =
            pathname == "/mycocktails"
                ? `/api/cocktails?page=${page}`
                : `/cocktails?category=Cocktail&page=${page}`;
        $.ajax({
            url,
            type: "GET",
            success: function (response) {
                $("#cocktail-list").append(response);
                loadVisibleCards(); // Cargar detalles de los nuevos elementos
            },
            error: function (error) {
                console.log("Error al obtener los cócteles", error);
            },
            complete: function () {
                isLoading = false;
                $("#loading-message").addClass("hidden");
            },
        });
    }

    // Cargar la primera página de cócteles
    loadCocktails(currentPage);

    // Delegar el evento al botón "Cargar más"
    $(document).on("click", "#load-more", function () {
        let nextPage = $(this).data("next-page");
        $(this).remove();
        if (nextPage) {
            loadCocktails(nextPage);
        }
    });
});
