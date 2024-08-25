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
};

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
                datosObtenidos.material
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
    const { trabajador, maquina, material } = datosObtenidos;

    // Cálculo del Costo por Hora de la Máquina
    const costoTotalMaquina = parseFloat(maquina.costo);
    const vidaUtilAnios = parseFloat(maquina.vida_util_anios);
    const horasUtiles = vidaUtilAnios * 365 * 24; // Supone que la máquina puede trabajar continuamente todos los días
    const costoMantenimiento = parseFloat(maquina.costo_mantenimiento || 0); // Aseguramos que el costo de mantenimiento sea un número
    const costoPorHoraMaquina =
        (costoTotalMaquina + costoMantenimiento) / horasUtiles;

    console.log("Costo por Hora de la Máquina:", costoPorHoraMaquina);

    // Obtención de las horas de impresión del trabajo actual
    const horasImpresion = parseFloat(
        document.getElementById("horas_impresion").value
    );

    // Cálculo del costo total de uso de la máquina para el trabajo actual
    const costoTotalUsoMaquina = costoPorHoraMaquina * horasImpresion;

    console.log(
        "Costo Total Uso de la Máquina para este trabajo:",
        costoTotalUsoMaquina
    );

    // Cálculo del Costo por Hora del Trabajador
    const costoPorHoraTrabajador = parseFloat(trabajador.costo_por_hora);

    // Cálculo del costo total del trabajador para el trabajo actual
    const costoTotalTrabajador = costoPorHoraTrabajador * horasImpresion;

    console.log(
        "Costo Total del Trabajador para este trabajo:",
        costoTotalTrabajador
    );

    // Cálculo del Costo de Materiales

    // Obtén la cantidad de desperdicio
    const cantidadDesperdicio = parseFloat(
        document.getElementById("desperdicio").value
    );

    const cantidadMaterialUsada = parseFloat(
        document.getElementById("cantidad_usada").value
    );

    // Convierte los valores a números flotantes
    const costoPorUnidadMaterial = parseFloat(material.costo_por_unidad);
    const cantidadDeMaterial = parseFloat(material.cantidad_de_material);

    // Calcula el costo total de materiales
    const costoMateriales =
        (cantidadMaterialUsada + cantidadDesperdicio) * costoPorUnidadMaterial;

    console.log("Costo de Materiales:", costoMateriales);

    // Cálculo del Costo Total del Producto
    const costoTotal =
        costoTotalUsoMaquina + costoTotalTrabajador + costoMateriales;

    // Margen de beneficio (10% por ejemplo)
    const margenBeneficio = 0.1;
    const costoSugerido = costoTotal * (1 + margenBeneficio);

    console.log("Costo Total del Producto:", costoTotal);
    console.log("Costo Sugerido del Producto:", costoSugerido);

    // Mostrar el costo sugerido en la interfaz de usuario
    document.getElementById(
        "costoSugerido"
    ).textContent = `Costo Sugerido del Producto: $${costoSugerido.toFixed(2)}`;
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

    obtenerDatos(`/trabajadores/${trabajadorId}/datos`, "trabajador");
    obtenerDatos(`/maquinas/${maquinaId}/datos`, "maquina");
    obtenerDatos(`/materiales/${materialId}/datos`, "material");
}

// Hacer la función global para ser usada desde HTML
window.calcularCosto = calcularCosto;
