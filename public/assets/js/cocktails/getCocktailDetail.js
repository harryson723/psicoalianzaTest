function loadVisibleCards() {
    $(".cocktail-card-wrapper").each(function () {
        let wrapper = $(this);
        let cocktailId = wrapper.data("id");
        let escapedId = CSS.escape(`card-${cocktailId}`);
        let card = $(`#${escapedId}`);

        if (
            wrapper.offset().top < $(window).scrollTop() + $(window).height() &&
            !wrapper.data("loaded")
        ) {
            wrapper.data("loaded", true);
            fetchCocktailDetails(cocktailId, wrapper, card);
        }
    });
}

function fetchCocktailDetails(id, wrapper, card) {
    const { pathname } = window.location;
    if (pathname != "/dashboard") {
        wrapper.find(".loading-message").remove();
        return card.fadeIn();
    }

    $.ajax({
        url: `https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=${id}`,
        type: "GET",
        success: function (response) {
            let details = response.drinks ? response.drinks[0] : null;

            if (details) {
                card.find("h3").text(details.strDrink);
                card.find("img")
                    .attr("src", details.strDrinkThumb)
                    .attr("alt", details.strDrink);
                card.find(".cocktail-details").html(`
                            <p class="cocktail-glass"><strong>Vaso recomendado:</strong> ${details.strGlass}</p>
                            <p class="cocktail-description"><strong>Instrucciones:</strong> ${details.strInstructions}</p>
                        `);
                wrapper.find(".loading-message").remove();
                card.fadeIn();
            } else {
                wrapper
                    .find(".loading-message")
                    .text("Detalles no encontrados.");
            }
        },
        error: function (xhr) {
            if (xhr.errorText === "error") {
                wrapper
                    .find(".loading-message")
                    .text("Demasiadas solicitudes, esperando...");
                setTimeout(() => {
                    fetchCocktailDetails(id, wrapper, card);
                }, 5000);
            } else {
                wrapper
                    .find(".loading-message")
                    .text("Error al cargar el cóctel.");
            }
        },
        complete: function () {
            isLoading = false;
        },
    });
}

$(window).on("scroll resize", function () {
    setTimeout(loadVisibleCards, 500);
});
