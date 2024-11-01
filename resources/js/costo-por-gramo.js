document
    .getElementById("materialForm")
    .addEventListener("submit", async function (event) {
        event.preventDefault(); // Evitar el envío inmediato del formulario

        const moneda = document.getElementById("moneda").value;
        const cantidadDeMaterial = parseFloat(
            document.getElementById("cantidad_de_material").value
        );
        const costoPorUnidadInput = document.getElementById("costo_por_unidad");
        const costoPorGramoInput = document.getElementById("costo_por_gramo");

        let costoPorUnidad = parseFloat(costoPorUnidadInput.value);

        if (moneda === "ARS") {
            try {
                const valorDolar = await obtenerPrecioDolar("/cotizacion");
                if (valorDolar) {
                    // Convertir el costo a dólares
                    costoPorUnidad = costoPorUnidad / valorDolar;
                    costoPorUnidadInput.value = costoPorUnidad.toFixed(3); // Actualizar el valor en el campo

                    // Cambiar la moneda a USD antes de enviar
                    document.getElementById("moneda").value = "USD";
                }
            } catch (error) {
                console.error("Error al convertir el precio a dólares:", error);
                return; // No enviar el formulario si hay un error
            }
        }

        // Calcular el costo por gramo
        let costoPorGramo = costoPorUnidad / cantidadDeMaterial;

        // Asignar el costo por gramo al campo oculto
        costoPorGramoInput.value = costoPorGramo.toFixed(3);

        // Enviar el formulario
        this.submit();
    });
