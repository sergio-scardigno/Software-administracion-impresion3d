$(document).ready(function () {
    $("#nombre").on("input", function () {
        var searchQuery = $(this).val().trim(); // Obtén el valor del input y elimina espacios al principio y al final

        if (searchQuery.length > 2) {
            // Reemplaza los espacios con "+"
            var formattedQuery = searchQuery.replace(/\s+/g, "+");

            $.ajax({
                url: "/proxy/precios",
                method: "GET",
                data: { search: formattedQuery },
                dataType: "json", // Asegúrate de que la respuesta sea interpretada como JSON
                success: function (response) {
                    $("#resultados").empty();

                    try {
                        // Asegúrate de que response sea un array
                        if (Array.isArray(response) && response.length > 0) {
                            response.forEach(function (negocio) {
                                if (
                                    Array.isArray(negocio.productos) &&
                                    negocio.productos.length > 0
                                ) {
                                    negocio.productos.forEach(function (
                                        producto
                                    ) {
                                        var itemHTML =
                                            '<div class="resultado-item">' +
                                            "<p><strong>Nombre:</strong> " +
                                            producto.title +
                                            "</p>" +
                                            "<p><strong>Presentación:</strong> " +
                                            producto.presentacion +
                                            "</p>" +
                                            "<p><strong>Precio:</strong> " +
                                            (producto.precio
                                                ? producto.precio
                                                : "No disponible") +
                                            "</p>" +
                                            '<p><a href="' +
                                            producto.producto_url +
                                            '" target="_blank">Ver producto</a></p>' +
                                            "</div>";
                                        $("#resultados").append(itemHTML);
                                    });
                                } else {
                                    $("#resultados").html(
                                        "<p>No se encontraron productos.</p>"
                                    );
                                }
                            });
                        } else {
                            $("#resultados").html(
                                "<p>No se encontraron resultados.</p>"
                            );
                        }
                    } catch (e) {
                        console.error("Error al procesar la respuesta:", e);
                        $("#resultados").html(
                            "<p>Error al procesar los resultados.</p>"
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error al consultar la API:", error);
                    $("#resultados").html(
                        "<p>Error al cargar los resultados.</p>"
                    );
                },
            });
        } else {
            $("#resultados").empty();
        }
    });
});
