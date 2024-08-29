// Sacar la cantidad de horas al crear una impresion
// Este es tu archivo fuente original
document
    .getElementById("fecha_inicio")
    .addEventListener("change", calcularHoras);
document.getElementById("fecha_fin").addEventListener("change", calcularHoras);

function calcularHoras() {
    const fechaInicio = new Date(document.getElementById("fecha_inicio").value);
    const fechaFin = new Date(document.getElementById("fecha_fin").value);

    if (fechaInicio && fechaFin && fechaFin > fechaInicio) {
        const diffMs = fechaFin - fechaInicio; // Diferencia en milisegundos
        const diffHrs = diffMs / (1000 * 60 * 60); // Convertir a horas
        document.getElementById("horas_impresion").value = Math.floor(diffHrs); // Mostrar sin decimales
    } else {
        document.getElementById("horas_impresion").value = ""; // Limpiar el campo si no es válido
    }

    console.log("Este es un mensaje de prueba"); // Asegúrate de que esto está en tu archivo original
    console.log(
        "Horas calculadas:",
        document.getElementById("horas_impresion").value
    );
}


$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Selecciona una opción",
        allowClear: true
    });
});