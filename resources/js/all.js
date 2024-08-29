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


// Cambios con select2

$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Selecciona una opción",
        allowClear: true
    });
});

let materialCount = 1;

function agregarMaterial() {
    const container = document.getElementById('materiales-container');
    const newMaterialGroup = document.createElement('div');
    newMaterialGroup.classList.add('material-group');

    newMaterialGroup.innerHTML = `
        <div class="mb-3">
            <label for="materiales[${materialCount}][id_material]" class="form-label">Material:</label>
            <select id="materiales[${materialCount}][id_material]" name="materiales[${materialCount}][id_material]" class="form-select select2" required>
                <option value="" disabled selected>Selecciona un material</option>
                @foreach ($materiales as $material)
                    <option value="{{ $material->id_material }}">{{ $material->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="materiales[${materialCount}][cantidad_usada]" class="form-label">Cantidad Usada en Kilos de Material:</label>
            <input type="number" step="0.01" id="materiales[${materialCount}][cantidad_usada]" name="materiales[${materialCount}][cantidad_usada]" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="materiales[${materialCount}][costo]" class="form-label">Costo del Material:</label>
            <input type="number" step="0.01" id="materiales[${materialCount}][costo]" name="materiales[${materialCount}][costo]" class="form-control" required>
        </div>
    `;

    container.appendChild(newMaterialGroup);
    $('.select2').select2({
        placeholder: "Selecciona una opción",
        allowClear: true
    });
    materialCount++;
}

function calcularCosto() {
    // Lógica para calcular el costo sugerido
    let costoSugerido = 0;
    // Calcular costo basado en los materiales y otros inputs
    document.getElementById('costoSugerido').innerText = `Costo Sugerido del Producto: $${costoSugerido.toFixed(2)}`;
}