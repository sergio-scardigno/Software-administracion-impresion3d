vagrant rsync para sincronizar la carpeta, esto es por Vite y la configuracion de Homestead.yml

# Tomar la cotizacion del dolar todos los dias

-   -   -   -   -   /usr/bin/php /path/to/your/project/artisan schedule:run >> /dev/null 2>&1

# Comando para probar manualmente

php artisan dolar:obtener

# Cotizacion tomada de

https://dolarapi.com/v1/dolares/blue

# Para generar los nuevos vite

Esto hace que genere los archivos minificados de all.js
npm run build

# Calculo de costo

(Trabajando) Costo por Hora de la Maquina = ( Costo total de la maquina + Costo de Mantenimiento ) / Horas Utiles

Costo por Hora del Trabajador = Horas de Trabajo al Mes / Salario Mensual

Costo de materiales = (cantidad de material usado + cantidad de material desperdiciado) \* costo por unidad de material.

# Total

Costo Total = (Costo por Hora de la maquina x Horas de impresion) + (Costo por hora de trabajador \* Horas de Impresion) + (Costo de Materiales + Costo de Desperdicio)

# Precio de Venta

Precio de Venta = Costo Total×(1+Margen de Ganancia)

# Modificaciones para hacer

Para implementar todas las fórmulas necesarias para calcular el costo de impresión en tu base de datos, considerar las siguientes modificaciones y ajustes en las tablas existentes:

TRABAJADO - ### 1. **Tabla `maquinas`**

-   **Agregar una columna `costo_energia_por_hora`:** Para almacenar el costo de energía por hora de cada máquina.
-   **Agregar una columna `costo_mantenimiento_por_hora`:** Para almacenar el costo de mantenimiento por hora.
-   **Agregar una columna `horas_utilizadas`:** Para llevar un registro de las horas utilizadas por la máquina, que te ayudará a calcular la amortización.

### 2. **Tabla `trabajadores`**

TRABAJADO - **Agregar una columna `costo_por_hora`:** Para almacenar el costo por hora del trabajador, que puede calcularse con la relación entre el salario y las horas trabajadas.

### 3. **Tabla `impresiones`**

-   **Agregar una columna `costo_materiales`:** Para almacenar el costo total de los materiales utilizados en la impresión.
-   **Agregar una columna `costo_desperdicio`:** Para almacenar el costo del material desperdiciado durante la impresión.
-   **Agregar una columna `costo_total`:** Para almacenar el costo total de la impresión, calculado automáticamente.
-   **Agregar una columna `precio_venta`:** Para almacenar el precio de venta si aplica.

### 4. **Tabla `gastos_fijos`**

TRABAJANDO - **Agregar una columna `categoria`:** (si no está presente) para categorizar los gastos como energía, mantenimiento, etc., para facilitar la agregación y distribución de costos.

### 5. **Nueva tabla `materiales`**

TRABAJANDO - **Agregar una tabla `materiales`:** donde se registren todos los materiales utilizados en las impresiones, con columnas como `id_material`, `nombre`, `costo_por_unidad`, y `unidad_de_medida`. Esto permitirá relacionar las impresiones con los materiales utilizados.

-   **Tabla intermedia `impresion_material`:** Para manejar una relación muchos a muchos entre `impresiones` y `materiales`. Esta tabla podría incluir `id_impresion`, `id_material`, `cantidad_usada`, y `costo`.

### 6. **Cálculos y Procedimientos**

TRABAJANDO - **Agregar triggers o stored procedures:** para actualizar automáticamente el costo total de la impresión (`costo_total`) cada vez que se actualicen las horas de impresión, el material utilizado, el trabajador asignado, etc.

### 7. **Relaciones**

TRABAJANDO - **Relacionar `impresiones` con `materiales`:** A través de la tabla intermedia `impresion_material`, para poder calcular los costos de los materiales de forma precisa.

### 8. **Consulta de los Costos**

-   **Crear una vista o un reporte:** Que consolide los costos de impresión por máquina, trabajador, materiales, y desperdicio para facilitar la revisión y análisis.

### 9. **Optimización**

-   **Índices en columnas clave:** Asegúrate de que las columnas que participarán en las consultas y cálculos frecuentes tengan índices para mejorar el rendimiento de las consultas.

### Cálculo de Costo en Función del Tiempo de la Máquina y el Tiempo del Operador

1. **Costo del Tiempo de Máquina**:

    - **Fórmula**:
      \[
      \text{Costo de Máquina} = (\text{Costo del Material} + \text{Costo de Energía} + \text{Costo de Desgaste de la Máquina}) \times \text{Horas de Impresión}
      \]
    - Este costo se calcula en función del tiempo total que la máquina está funcionando.

2. **Costo de Horas Hombre**:
    - **Fórmula**:
      \[
      \text{Costo de Horas Hombre} = \text{Horas Hombre Efectivas} \times \text{Costo por Hora Hombre}
      \]
    - Aquí solo se cuenta el tiempo efectivo que el operador está trabajando en el proyecto.

### Ejemplo:

Supongamos que:

-   La impresora trabaja 24 horas para una impresión, pero el operador solo necesita 2 horas en total para preparar y finalizar el trabajo.
-   El operador cuesta $20 por hora.
-   El resto de los costos (material, energía, desgaste) ya se han calculado previamente, y para este ejemplo, suman $15 por hora de uso de la impresora.

1. **Costo de Máquina**:
   \[
   15 \, \text{USD/h} \times 24 \, \text{h} = 360 \, \text{USD}
   \]

2. **Costo de Horas Hombre**:
   \[
   2 \, \text{h} \times 20 \, \text{USD/h} = 40 \, \text{USD}
   \]

3. **Costo Total**:
   \[
   \text{Costo Total} = \text{Costo de Máquina} + \text{Costo de Horas Hombre}
   \]
   \[
   360 \, \text{USD} + 40 \, \text{USD} = 400 \, \text{USD}
   \]

4. **Costo Total con Margen de Ganancia** (si decides aplicar un margen del 30%):
   \[
   400 \, \text{USD} \times 1.3 = 520 \, \text{USD}
   \]

### Relación entre Tiempo de Máquina y Horas Hombre

Una forma de visualizar esto es mediante un **factor de eficiencia**:

-   **Factor de Eficiencia**: Relación entre las horas hombre y las horas de máquina.
-   **Fórmula**:
    \[
    \text{Factor de Eficiencia} = \frac{\text{Horas Hombre}}{\text{Horas de Impresión}}
    \]
    -   En el ejemplo:
        \[
        \text{Factor de Eficiencia} = \frac{2}{24} = 0.0833
        \]
    -   Esto significa que por cada hora de impresión, solo 8.33% del tiempo es tiempo humano activo.

Puedes usar este factor de eficiencia para ajustar el cálculo si, por ejemplo, decides que el costo de las horas hombre debe tener un peso específico en el costo total.

### Resumen:

-   **Costo del Tiempo de Máquina**: Se basa en el tiempo de uso total de la impresora.
-   **Costo de Horas Hombre**: Se basa en el tiempo real que el operador está trabajando.
-   **Relación**: El tiempo de máquina generalmente será mucho mayor que el tiempo humano, por lo que la mayoría del costo vendrá del uso de la impresora. Sin embargo, es importante no subestimar el costo de las horas hombre, ya que pueden incluir tareas críticas como la configuración y el acabado, que impactan directamente en la calidad del producto final.
