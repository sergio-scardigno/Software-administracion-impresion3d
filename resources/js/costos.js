// function calcularCosto() {
//     const trabajadorId = document.getElementById("id_trabajador").value;
//     const maquinaId = document.getElementById("id_maquina").value;
//     const materialId = document.getElementById("material").value;
//     const desperdicio = document.getElementById("desperdicio").value;

//     if (!trabajadorId || !maquinaId || !materialId || !desperdicio) {
//         alert("Por favor selecciona un trabajador, una máquina y un material.");
//         return;
//     }

//     console.log("ID del trabajador seleccionado:", trabajadorId);
//     console.log("ID de la máquina seleccionada:", maquinaId);
//     console.log("ID del material seleccionado:", materialId);
//     console.log("Cantidad de Desperdicio en kilos:", desperdicio);

//     obtenerDatos(`/trabajadores/${trabajadorId}/datos`, "trabajador");
//     obtenerDatos(`/maquinas/${maquinaId}/datos`, "maquina");
//     obtenerDatos(`/materiales/${materialId}/datos`, "material");
// }

// function obtenerDatos(url, tipo) {
//     fetch(url)
//         .then((response) => response.json())
//         .then((data) => {
//             console.log(`Datos del ${tipo}:`, data);
//             // Lógica adicional para usar los datos obtenidos
//         })
//         .catch((error) =>
//             console.error(`Error al obtener datos del ${tipo}:`, error)
//         );
// }

// // Hacer la función global
// window.calcularCosto = calcularCosto;

// Objeto para almacenar los datos obtenidos
const datosObtenidos = {
    trabajador: null,
    maquina: null,
    material: null,
    valor_dolar: null, // Agregar valor_dolar aquí
};

const urlPrecioDolar = `/cotizacion`;

function obtenerPrecioDolar(url) {
    return fetch(url)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error en la respuesta de la red");
            }
            return response.json();
        })
        .then((data) => {
            if (data.valor_dolar) {
                console.log(`El precio del dólar es: ${data.valor_dolar}`);
                datosObtenidos.valor_dolar = data.valor_dolar; // Guardar el valor del dólar
                return data.valor_dolar;
            } else {
                console.error(
                    'La respuesta no contiene la clave "valor_dolar".'
                );
            }
        })
        .catch((error) =>
            console.error("Error al obtener el precio del dólar:", error)
        );
}

// Función para obtener datos de un endpoint y guardarlos en el objeto global
function obtenerDatos(url, tipo) {
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            console.log(`Datos del ${tipo}:`, data);
            datosObtenidos[tipo] = data;
            if (
                datosObtenidos.trabajador &&
                datosObtenidos.maquina &&
                datosObtenidos.material &&
                datosObtenidos.valor_dolar // Verificar que también se tenga el valor del dólar
            ) {
                calcularCostos();
            }
        })
        .catch((error) =>
            console.error(`Error al obtener datos del ${tipo}:`, error)
        );
}

// Función para calcular costos después de obtener todos los datos necesarios
function calcularCostos() {
    const { trabajador, maquina, material, valor_dolar } = datosObtenidos;

    // Cálculo del Costo por Hora de la Máquina (sin redondeo)
    const costoTotalMaquina = parseFloat(maquina.costo);
    const vidaUtilAnios = parseFloat(maquina.vida_util_anios);
    const horasUtiles = vidaUtilAnios * 365 * 24;
    const costoMantenimiento = parseFloat(maquina.costo_mantenimiento || 0);
    const costoPorHoraMaquina =
        (costoTotalMaquina + costoMantenimiento) / horasUtiles;

    console.log("Costo por Hora de la Máquina:", costoPorHoraMaquina);

    const horasImpresion = parseFloat(
        document.getElementById("horas_impresion").value
    );

    // Calculo del costo total de uso de la máquina (sin redondeo)
    const costoTotalUsoMaquina = costoPorHoraMaquina * horasImpresion;
    console.log(
        "Costo Total Uso de la Máquina para este trabajo:",
        costoTotalUsoMaquina
    );

    let costoPorHoraTrabajador = parseFloat(trabajador.costo_por_hora);
    costoPorHoraTrabajador = Math.round(costoPorHoraTrabajador);

    // Supongamos que el trabajador efectivamente trabaja un 10% del tiempo total de impresión
    let horasEfectivasTrabajador = horasImpresion * 0.1;
    horasEfectivasTrabajador = Math.round(horasEfectivasTrabajador);
    let costoTotalTrabajador =
        costoPorHoraTrabajador * horasEfectivasTrabajador;
    costoTotalTrabajador = Math.round(costoTotalTrabajador);

    console.log(
        "Horas efectivas del trabajador para este trabajo:",
        horasEfectivasTrabajador
    );
    console.log(
        "Costo Total del Trabajador para este trabajo:",
        costoTotalTrabajador
    );

    const cantidadDesperdicio = parseFloat(
        document.getElementById("desperdicio").value
    );

    const cantidadMaterialUsada = parseFloat(
        document.getElementById("cantidad_usada").value
    );

    let costoPorUnidadMaterial = parseFloat(material.costo_por_unidad);
    costoPorUnidadMaterial = Math.round(costoPorUnidadMaterial);
    let costoMateriales =
        (cantidadMaterialUsada + cantidadDesperdicio) * costoPorUnidadMaterial;
    costoMateriales = Math.round(costoMateriales);

    console.log("Costo de Materiales:", costoMateriales);

    let costoTotal =
        costoTotalUsoMaquina + costoTotalTrabajador + costoMateriales;
    costoTotal = Math.round(costoTotal);

    const margenBeneficio = 0.1;
    let costoSugeridoUSD = costoTotal * (1 + margenBeneficio);
    costoSugeridoUSD = Math.round(costoSugeridoUSD);

    // Convertir el costo sugerido a pesos argentinos
    let costoSugeridoARS = costoSugeridoUSD * valor_dolar;
    costoSugeridoARS = Math.round(costoSugeridoARS);

    console.log("Costo Total del Producto (USD):", costoTotal);
    console.log("Costo Sugerido del Producto (USD):", costoSugeridoUSD);
    console.log("Costo Sugerido del Producto (ARS):", costoSugeridoARS);

    // Cálculo adicional: factor ponderado
    const factor = 0.5; // Ajustar el factor según sea necesario
    let costoTotalPonderado =
        factor * costoPorHoraTrabajador * horasEfectivasTrabajador +
        (1 - factor) * costoPorHoraMaquina * horasImpresion;
    costoTotalPonderado = Math.round(costoTotalPonderado);

    console.log("Costo Total Ponderado:", costoTotalPonderado);

    // División del costo total si la cantidad de unidades es mayor a 1
    const cantidadUnidades = parseInt(
        document.getElementById("cantidad_unidades").value,
        10
    );

    if (cantidadUnidades > 1) {
        const costoPorUnidad = costoSugeridoARS / cantidadUnidades;
        console.log(
            `Costo por Unidad (${cantidadUnidades} unidades): $${costoPorUnidad.toFixed(
                2
            )} ARS`
        );
    }

    document.getElementById(
        "costoSugerido"
    ).textContent = `Costo Sugerido del Producto: $${costoSugeridoARS} ARS`;
}

// Función principal para iniciar el proceso de cálculo de costos
function calcularCosto() {
    const trabajadorId = document.getElementById("id_trabajador").value;
    const maquinaId = document.getElementById("id_maquina").value;
    const materialId = document.getElementById("material").value;
    const desperdicio = document.getElementById("desperdicio").value;

    if (!trabajadorId || !maquinaId || !materialId || !desperdicio) {
        alert("Por favor selecciona un trabajador, una máquina y un material.");
        return;
    }

    console.log("ID del trabajador seleccionado:", trabajadorId);
    console.log("ID de la máquina seleccionada:", maquinaId);
    console.log("ID del material seleccionado:", materialId);
    console.log("Cantidad de Desperdicio en kilos:", desperdicio);

    obtenerPrecioDolar(urlPrecioDolar).then(() => {
        obtenerDatos(`/trabajadores/${trabajadorId}/datos`, "trabajador");
        obtenerDatos(`/maquinas/${maquinaId}/datos`, "maquina");
        obtenerDatos(`/materiales/${materialId}/datos`, "material");
    });
}

// Hacer la función global para ser usada desde HTML
window.calcularCosto = calcularCosto;
