// Este script saca bien las cuentas
// async function calcularCostos(datosObtenidos) {
//     const { trabajadores, maquinas, materiales, valor_dolar } = datosObtenidos;

//     let costoTotalMaquina = 0;
//     let costoTotalTrabajador = 0;
//     let costoMateriales = 0;

//     const horasImpresion = parseFloat(
//         document.getElementById("horas_impresion").value
//     );
//     if (isNaN(horasImpresion) || horasImpresion <= 0) {
//         console.error("Horas de impresión no válidas.");
//         return;
//     }

//     console.log("Inicio del cálculo de costos:");
//     console.log(`Horas de impresión: ${horasImpresion}`);

//     // Calcular el costo total de uso de máquinas
//     for (const maquina of maquinas) {
//         const costoTotalMaquinaUnidad = parseFloat(maquina.costo);
//         const vidaUtilAnios = parseFloat(maquina.vida_util_anios);
//         const horasUtiles = vidaUtilAnios * 365 * 24;
//         const costoMantenimiento = parseFloat(maquina.costo_mantenimiento || 0);
//         const costoPorHoraMaquina =
//             (costoTotalMaquinaUnidad + costoMantenimiento) / horasUtiles;
//         const costoTotalUsoMaquina = costoPorHoraMaquina * horasImpresion;

//         costoTotalMaquina += parseFloat(costoTotalUsoMaquina);
//     }

//     console.log(
//         `Costo total antes de distribución de máquinas: ${costoTotalMaquina}`
//     );

//     if (maquinas.length > 1) {
//         costoTotalMaquina /= maquinas.length;
//     }

//     console.log(
//         `Costo total de las máquinas después de distribución: ${costoTotalMaquina}`
//     );

//     // Calcular costo total de trabajadores
//     for (const trabajador of trabajadores) {
//         const costoPorHoraTrabajador = parseFloat(trabajador.costo_por_hora);

//         if (isNaN(costoPorHoraTrabajador) || costoPorHoraTrabajador <= 0) {
//             console.error("Costo por hora no válido para un trabajador.");
//             continue;
//         }

//         const horasEfectivasTrabajador = horasImpresion; // Ajustar según sea necesario
//         const costoTotalTrabajadorItem =
//             costoPorHoraTrabajador * horasEfectivasTrabajador;

//         costoTotalTrabajador += parseFloat(costoTotalTrabajadorItem);
//     }

//     console.log(
//         `Costo total acumulado de trabajadores: ${costoTotalTrabajador}`
//     );

//     if (trabajadores.length > 1) {
//         costoTotalTrabajador /= trabajadores.length;
//     }

//     console.log(
//         `Costo total de los trabajadores después de distribución: ${costoTotalTrabajador}`
//     );

//     // Calcular costo total de materiales
//     for (const [index, material] of materiales.entries()) {
//         const cantidadMaterialUsadaElement = document.querySelector(
//             `[name="materiales[${index}][cantidad_usada]"]`
//         );
//         const desperdicioElement = document.getElementById("desperdicio");

//         if (!cantidadMaterialUsadaElement || !desperdicioElement) {
//             console.error(
//                 `No se encontró el elemento para material en índice ${index}`
//             );
//             continue;
//         }

//         const cantidadMaterialUsada = parseFloat(
//             cantidadMaterialUsadaElement.value
//         );
//         const desperdicio = parseFloat(desperdicioElement.value);

//         if (isNaN(cantidadMaterialUsada) || isNaN(desperdicio)) {
//             console.error(
//                 `Cantidad de material usada o desperdicio no es válida para material en índice ${index}`
//             );
//             continue;
//         }

//         const cantidadTotalUsada = cantidadMaterialUsada + desperdicio;

//         console.log(`Costo total de cantidadTotalUsada: ${cantidadTotalUsada}`);

//         //const CantidadTotalUsadaEnGramos = cantidadTotalUsada / 1000;

//         const costoPorUnidadMaterial = parseFloat(material.costo_por_unidad);

//         // Sacamos el costo por gramo

//         const costoPorGramo = parseFloat(material.costo_por_gramo);

//         console.log(`Costo total de costoPorGramo: ${costoPorGramo}`);

//         if (isNaN(costoPorUnidadMaterial)) {
//             console.error(
//                 `Costo por unidad del material no es válido para material en índice ${index}`
//             );
//             continue;
//         }

//         // Definir la cantidad de material en gramos o kilos (puede ajustarse según tus necesidades)
//         //const cantidadMaterial = 750; // 1 KG = 1000 GR (Ajustar según el valor que quieras usar)
//         const costoMaterialItem = cantidadTotalUsada * costoPorGramo;

//         //console.log(`Costo total de costoMaterialItem: ${costoMaterialItem}`);

//         costoMateriales += parseFloat(costoMaterialItem);
//     }

//     console.log(`Costo total de materiales: ${costoMateriales}`);

//     // Calcular el costo total
//     let costoTotal = costoTotalMaquina + costoTotalTrabajador + costoMateriales;
//     costoTotal = parseFloat(costoTotal);

//     console.log("Costo total del producto (sin margen):", costoTotal);

//     // Aplicar margen de beneficio
//     const margenBeneficio = 0.1;
//     let costoSugeridoUSD = costoTotal * (1 + margenBeneficio);
//     costoSugeridoUSD = parseFloat(costoSugeridoUSD);

//     // Convertir a ARS
//     let costoSugeridoARS = costoSugeridoUSD * valor_dolar;
//     costoSugeridoARS = parseFloat(costoSugeridoARS);

//     console.log("Costo Sugerido del Producto (USD):", costoSugeridoUSD);
//     console.log("Costo Sugerido del Producto (ARS):", costoSugeridoARS);

//     // Calcular costo total ponderado
//     const factor = 0.5;
//     let costoTotalPonderado =
//         factor * costoTotalTrabajador + (1 - factor) * costoTotalMaquina;
//     costoTotalPonderado = parseFloat(costoTotalPonderado);

//     console.log("Costo Total Ponderado:", costoTotalPonderado);

//     const cantidadUnidades = parseInt(
//         document.getElementById("cantidad_unidades").value,
//         10
//     );
//     if (!isNaN(cantidadUnidades) && cantidadUnidades > 1) {
//         const costoPorUnidad = costoSugeridoARS / cantidadUnidades;
//         console.log(
//             `Costo por Unidad (${cantidadUnidades} unidades): $${costoPorUnidad.toFixed(
//                 2
//             )} ARS`
//         );
//     }

//     document.getElementById(
//         "costoSugerido"
//     ).textContent = `Costo Sugerido del Producto: $${costoSugeridoARS} ARS`;
// }

// Este script tambien funciona

async function calcularCostos(datosObtenidos) {
    const { trabajadores, maquinas, materiales, valor_dolar } = datosObtenidos;

    let costoTotalMaquinaUSD = 0;
    let costoTotalTrabajadorUSD = 0;
    let costoMaterialesUSD = 0;

    const horasImpresion = parseFloat(
        document.getElementById("horas_impresion").value
    );
    if (isNaN(horasImpresion) || horasImpresion <= 0) {
        console.error("Horas de impresión no válidas.");
        return;
    }

    console.log("Inicio del cálculo de costos:");
    console.log(`Horas de impresión: ${horasImpresion}`);

    // Calcular el costo total de uso de máquinas
    for (const maquina of maquinas) {
        const costoTotalMaquinaUnidad = parseFloat(maquina.costo);
        const vidaUtilAnios = parseFloat(maquina.vida_util_anios);
        const horasUtiles = vidaUtilAnios * 365 * 24;
        const costoMantenimiento = parseFloat(maquina.costo_mantenimiento || 0);
        const costoPorHoraMaquina =
            (costoTotalMaquinaUnidad + costoMantenimiento) / horasUtiles;
        const costoTotalUsoMaquina = costoPorHoraMaquina * horasImpresion;

        costoTotalMaquinaUSD += parseFloat(costoTotalUsoMaquina);
    }

    console.log(
        `Costo total antes de distribución de máquinas: ${costoTotalMaquinaUSD}`
    );

    if (maquinas.length > 1) {
        costoTotalMaquinaUSD /= maquinas.length;
    }

    console.log(
        `Costo total de las máquinas después de distribución: ${costoTotalMaquinaUSD}`
    );

    // Calcular costo total de trabajadores
    for (const trabajador of trabajadores) {
        const costoPorHoraTrabajador = parseFloat(trabajador.costo_por_hora);

        if (isNaN(costoPorHoraTrabajador) || costoPorHoraTrabajador <= 0) {
            console.error("Costo por hora no válido para un trabajador.");
            continue;
        }

        const horasEfectivasTrabajador = horasImpresion;
        const costoTotalTrabajadorItem =
            costoPorHoraTrabajador * horasEfectivasTrabajador;

        costoTotalTrabajadorUSD += parseFloat(costoTotalTrabajadorItem);
    }

    console.log(
        `Costo total acumulado de trabajadores: ${costoTotalTrabajadorUSD}`
    );

    if (trabajadores.length > 1) {
        costoTotalTrabajadorUSD /= trabajadores.length;
    }

    console.log(
        `Costo total de los trabajadores después de distribución: ${costoTotalTrabajadorUSD}`
    );

    // Calcular costo total de materiales
    for (const [index, material] of materiales.entries()) {
        const cantidadMaterialUsadaElement = document.querySelector(
            `[name="materiales[${index}][cantidad_usada]"]`
        );
        const desperdicioElement = document.getElementById("desperdicio");

        if (!cantidadMaterialUsadaElement || !desperdicioElement) {
            console.error(
                `No se encontró el elemento para material en índice ${index}`
            );
            continue;
        }

        const cantidadMaterialUsada = parseFloat(
            cantidadMaterialUsadaElement.value
        );
        const desperdicio = parseFloat(desperdicioElement.value);

        if (isNaN(cantidadMaterialUsada) || isNaN(desperdicio)) {
            console.error(
                `Cantidad de material usada o desperdicio no es válida para material en índice ${index}`
            );
            continue;
        }

        const cantidadTotalUsada = cantidadMaterialUsada + desperdicio;

        const costoPorGramo = parseFloat(material.costo_por_gramo);

        if (isNaN(costoPorGramo)) {
            console.error(
                `Costo por gramo del material no es válido para material en índice ${index}`
            );
            continue;
        }

        const costoMaterialItem = cantidadTotalUsada * costoPorGramo;

        costoMaterialesUSD += parseFloat(costoMaterialItem);

        // Actualizar el campo del costo en el formulario
        const costoField = document.getElementById(`material-costo-${index}`);
        if (costoField) {
            costoField.value = costoMaterialItem.toFixed(2);
        }

        console.log(`Peso total de materiales: ${cantidadTotalUsada}`);
        console.log(`Precio de cada material: ${costoPorGramo}`);
    }

    console.log(`Costo total de materiales: ${costoMaterialesUSD}`);

    // Calcular el costo total en USD
    let costoTotalUSD =
        costoTotalMaquinaUSD + costoTotalTrabajadorUSD + costoMaterialesUSD;
    costoTotalUSD = parseFloat(costoTotalUSD);

    console.log("Costo total del producto (sin margen):", costoTotalUSD);

    // Aplicar margen de beneficio
    const margenBeneficio = 0.1;
    let costoSugeridoUSD = costoTotalUSD * (1 + margenBeneficio);
    costoSugeridoUSD = parseFloat(costoSugeridoUSD);

    // Convertir a ARS
    let costoSugeridoARS = costoSugeridoUSD * valor_dolar;
    costoSugeridoARS = parseFloat(costoSugeridoARS);

    console.log("Costo Sugerido del Producto (USD):", costoSugeridoUSD);
    console.log("Costo Sugerido del Producto (ARS):", costoSugeridoARS);

    console.log("Sacando costo total", valor_dolar);

    let constoTotalARG = costoTotalUSD * valor_dolar;

    console.log("Sacando costo total", constoTotalARG);

    // Mostrar el costo total y el costo sugerido en ARS
    const totalCostDisplay = document.getElementById("total-cost-display");
    if (totalCostDisplay) {
        totalCostDisplay.textContent = `Costo Total: ${constoTotalARG.toFixed(
            2
        )} ARS`;
    }

    // Calcular costo total ponderado en USD y ARS
    const factor = 0.5;
    let costoTotalPonderadoUSD =
        factor * costoTotalTrabajadorUSD + (1 - factor) * costoTotalMaquinaUSD;
    costoTotalPonderadoUSD = parseFloat(costoTotalPonderadoUSD);

    let costoTotalPonderadoARS = costoTotalPonderadoUSD * valor_dolar;
    costoTotalPonderadoARS = parseFloat(costoTotalPonderadoARS);

    console.log("Costo Total Ponderado (USD):", costoTotalPonderadoUSD);
    console.log("Costo Total Ponderado (ARS):", costoTotalPonderadoARS);

    const cantidadUnidades = parseInt(
        document.getElementById("cantidad_unidades").value,
        10
    );
    if (!isNaN(cantidadUnidades) && cantidadUnidades > 1) {
        const costoPorUnidadUSD = costoSugeridoUSD / cantidadUnidades;
        const costoPorUnidadARS = costoSugeridoARS / cantidadUnidades;
        console.log(
            `Costo por Unidad (${cantidadUnidades} unidades): $${costoPorUnidadUSD.toFixed(
                2
            )} USD / $${costoPorUnidadARS.toFixed(2)} ARS`
        );
    }

    document.getElementById(
        "costoSugerido"
    ).textContent = `Precio Sugerido del Producto: $${costoSugeridoARS.toFixed(
        2
    )} ARS / $${costoSugeridoUSD.toFixed(2)} USD`;
}

async function calcularCosto() {
    const datosObtenidos = {
        trabajadores: [],
        maquinas: [],
        materiales: [],
        valor_dolar: 0,
    };

    const trabajadorSelect = document.getElementById("id_trabajador");
    const trabajadorIds = Array.from(trabajadorSelect.selectedOptions).map(
        (option) => option.value
    );

    const maquinaSelect = document.getElementById("id_maquina");
    const maquinaIds = Array.from(maquinaSelect.selectedOptions).map(
        (option) => option.value
    );

    const materialIds = Array.from(
        document.querySelectorAll('[id^="materiales"][name*="[id_material]"]')
    ).map((input) => input.value);

    if (!trabajadorIds.length || !maquinaIds.length || !materialIds.length) {
        alert(
            "Por favor selecciona al menos un trabajador, una máquina y un material."
        );
        return;
    }

    try {
        const urlPrecioDolar = "/cotizacion";
        const valorDolar = await obtenerPrecioDolar(urlPrecioDolar);
        datosObtenidos.valor_dolar = valorDolar;

        // Obtener datos de trabajadores
        for (const id of trabajadorIds) {
            try {
                const trabajador = await obtenerDatos(
                    `/trabajadores/${id}/datos`,
                    "trabajador"
                );
                if (
                    trabajador &&
                    trabajador.trabajador_id &&
                    trabajador.trabajador_nombre
                ) {
                    datosObtenidos.trabajadores.push(trabajador);
                }
            } catch (error) {
                console.error(
                    `Error al obtener datos del trabajador ${id}:`,
                    error
                );
            }
        }

        // Obtener datos de máquinas
        for (const id of maquinaIds) {
            try {
                const maquina = await obtenerDatos(
                    `/maquinas/${id}/datos`,
                    "maquina"
                );
                if (maquina && maquina.costo && maquina.vida_util_anios) {
                    datosObtenidos.maquinas.push(maquina);
                }
            } catch (error) {
                console.error(
                    `Error al obtener datos de la máquina ${id}:`,
                    error
                );
            }
        }

        // Obtener datos de materiales
        for (const id of materialIds) {
            try {
                const material = await obtenerDatos(
                    `/materiales/${id}/datos`,
                    "material"
                );
                if (
                    material &&
                    material.id &&
                    material.nombre &&
                    material.costo_por_unidad &&
                    material.costo_por_gramo
                ) {
                    datosObtenidos.materiales.push(material);
                }
            } catch (error) {
                console.error(
                    `Error al obtener datos del material ${id}:`,
                    error
                );
            }
        }

        // Calcular costos usando los datos obtenidos
        await calcularCostos(datosObtenidos);
    } catch (error) {
        console.error("Error en el proceso de cálculo:", error);
    }
}

function agregarEventoCambio(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.addEventListener("change", calcularCosto);
    }
}

function agregarEventosCambioMateriales() {
    const elementosMateriales = document.querySelectorAll(
        '[name*="[cantidad_usada]"]'
    );
    elementosMateriales.forEach((elemento) => {
        elemento.addEventListener("change", calcularCosto);
    });
}

const urlPrecioDolar = `/cotizacion`;

async function obtenerPrecioDolar(url) {
    try {
        const response = await fetch(url);
        const data = await response.json();

        if (!response.ok || !data.valor_dolar) {
            throw new Error("No se pudo obtener el precio del dólar");
        }

        return data.valor_dolar;
    } catch (error) {
        console.error("Error al obtener el precio del dólar:", error);
        throw error;
    }
}

async function obtenerDatos(url, tipo, index = null) {
    try {
        const response = await fetch(url);
        const data = await response.json();

        if (!response.ok) {
            throw new Error(`No se pudo obtener los datos de ${tipo}`);
        }

        console.log(`Datos obtenidos de ${tipo} ${index}:`, data); // Agregado para depuración
        return data;
    } catch (error) {
        console.error(`Error al obtener los datos de ${tipo}:`, error);
        throw error;
    }
}

window.calcularCosto = calcularCosto;
