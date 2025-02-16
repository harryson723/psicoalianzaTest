function addCocktailToDB(id, name, image, email) {
    let card = $(`#card-${id}`);
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
    axios
        .delete(
            "/api/cocktails",
            {
                id,
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
            if (response.message == "Cóctel eliminado con éxito.")
                $.toast({
                    heading: "Operación exitosa.",
                    text: "Coctel eliminado correctamente.",
                    icon: "success",
                });
        })
        .catch((error) => {
            $.toast({
                heading: "Error en la operación.",
                text: "No se pudo eliminar el coctel",
                icon: "error",
            });
        });
}
