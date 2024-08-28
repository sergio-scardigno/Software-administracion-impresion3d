const urlPrecioDolar = `/cotizacion`;

function formatNumber(number) {
    return number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

document.addEventListener("DOMContentLoaded", async () => {
    const valorDolar = await obtenerPrecioDolar(urlPrecioDolar);

    if (valorDolar) {
        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach((row) => {
            const costoUnidadCell = row.querySelector("td:nth-child(2)");
            const costoUnidad = parseFloat(costoUnidadCell.textContent);
            const costoEnDolares = costoUnidad * valorDolar;
            costoUnidadCell.textContent = `$${formatNumber(costoEnDolares)}`;
        });
    }
});

document
    .getElementById("materialForm")
    .addEventListener("submit", async function (event) {
        event.preventDefault(); // Evitar el envío inmediato del formulario

        const moneda = document.getElementById("moneda").value;
        const costoPorUnidadInput = document.getElementById("costo_por_unidad");
        let costoPorUnidad = parseFloat(costoPorUnidadInput.value);

        if (moneda === "ARS") {
            try {
                const valorDolar = await obtenerPrecioDolar("/cotizacion");
                if (valorDolar) {
                    // Convertir el costo a dólares
                    const costoEnDolares = costoPorUnidad / valorDolar;
                    costoPorUnidadInput.value = costoEnDolares.toFixed(2); // Actualizar el valor en el campo

                    // Cambiar la moneda a USD antes de enviar
                    document.getElementById("moneda").value = "USD";
                }
            } catch (error) {
                console.error("Error al convertir el precio a dólares:", error);
                return; // No enviar el formulario si hay un error
            }
        }

        // Enviar el formulario
        this.submit();
    });

async function obtenerPrecioDolar(url) {
    const response = await fetch(url);
    const data = await response.json();

    if (!response.ok || !data.valor_dolar) {
        throw new Error("No se pudo obtener el precio del dólar");
    }

    return data.valor_dolar;
}
