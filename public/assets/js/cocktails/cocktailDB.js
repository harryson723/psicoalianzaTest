function addCocktailToDB(id, name, image, email) {
    let escapedId = CSS.escape(`card-${id}`);
    let card = $(`#${escapedId}`);
    const description =
        card
            .find(".cocktail-description")[0]
            ?.innerText.replace("Instrucciones: ", "") || "";
    const glass =
        card
            .find(".cocktail-glass")[0]
            ?.innerText.replace("Vaso recomendado: ", "") || "";
    axios
        .post(
            "/api/cocktails",
            {
                id: id.toString() + "-" + email,
                title: name,
                image,
                description: description,
                glass,
            },
            {
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector("meta[name='csrf-token']")
                        .getAttribute("content"),
                },
            }
        )
        .then((response) => {
            $.toast({
                heading: "Operación exitosa.",
                text: "Coctel agregado correctamente.",
                icon: "success",
            });
        })
        .catch((error) => {
            $.toast({
                heading: "Error en la operación.",
                text: "Ya existe en la base de datos",
                icon: "error",
            });
        });
}

function deleteCocktailDB(id) {
    let card = $(`[data-id="${id}"]`);
    axios
        .delete("/api/cocktails/" + id, {
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector("meta[name='csrf-token']")
                    .getAttribute("content"),
            },
        })
        .then((response) => {
            if (response.data.message === "Cóctel eliminado con éxito.") {
                if (card.parent().children().length <= 3) {
                    $(".cocktail-container")
                        .html(`<p class="w-full col-span-full text-center text-gray-600 dark:text-gray-400">
        No se han agregado cócteles aun.
    </p>`);
                } else card.remove();
                $.toast({
                    heading: "Operación exitosa.",
                    text: "Coctel eliminado correctamente.",
                    icon: "success",
                });
            }
        })
        .catch((error) => {
            $.toast({
                heading: "Error en la operación.",
                text: "No se pudo eliminar el coctel",
                icon: "error",
            });
        });
}

function updateCocktail(id, field, value) {
    axios
        .put(
            `/api/cocktails/${id}`,
            { [field]: value },
            {
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector("meta[name='csrf-token']")
                        .getAttribute("content"),
                },
            }
        )
        .then((response) => {
            $.toast({
                heading: "Actualización exitosa",
                text: `El campo ${field} fue actualizado.`,
                icon: "success",
            });
        })
        .catch((error) => {
            $.toast({
                heading: "Error en la actualización",
                text: "No se pudo actualizar el cóctel.",
                icon: "error",
            });
        });
}
