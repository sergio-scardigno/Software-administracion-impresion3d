vagrant rsync para sincronizar la carpeta, esto es por Vite y la configuracion de Homestead.yml

# Para generar los nuevos vite

Esto hace que genere los archivos minificados de all.js
npm run build

# Calculo de costo

Costo por Hora de la Maquina = ( Costo total de la maquina / Horas Utiles + Costo de Mantenimiento / Horas Utiles)

Costo por Hora del Trabajador = Horas de Trabajo al Mes / Salario Mensual

Costo de Materiales Cantidad de Material Usado x Costo por Unidad de Material

Costo de Desperdicio = Cantidad de Material Desperdiciado x Costo por Unidad de Material

# Total

Costo Total = (Costo por Hora de la maquina x Horas de impresion) + (Costo por hora de trabajador + Horas de Impresion) + (Costo de Materiales + Costo de Desperdicio)

# Precio de Venta

Precio de Venta = Costo Total×(1+Margen de Ganancia)

# Modificaciones para hacer

Para implementar todas las fórmulas necesarias para calcular el costo de impresión en tu base de datos, considerar las siguientes modificaciones y ajustes en las tablas existentes:

### 1. **Tabla `maquinas`**

-   **Agregar una columna `costo_energia_por_hora`:** Para almacenar el costo de energía por hora de cada máquina.
-   **Agregar una columna `costo_mantenimiento_por_hora`:** Para almacenar el costo de mantenimiento por hora.
-   **Agregar una columna `horas_utilizadas`:** Para llevar un registro de las horas utilizadas por la máquina, que te ayudará a calcular la amortización.

### 2. **Tabla `trabajadores`**

-   **Agregar una columna `costo_por_hora`:** Para almacenar el costo por hora del trabajador, que puede calcularse con la relación entre el salario y las horas trabajadas.

### 3. **Tabla `impresiones`**

-   **Agregar una columna `costo_materiales`:** Para almacenar el costo total de los materiales utilizados en la impresión.
-   **Agregar una columna `costo_desperdicio`:** Para almacenar el costo del material desperdiciado durante la impresión.
-   **Agregar una columna `costo_total`:** Para almacenar el costo total de la impresión, calculado automáticamente.
-   **Agregar una columna `precio_venta`:** Para almacenar el precio de venta si aplica.

### 4. **Tabla `gastos_fijos`**

-   **Agregar una columna `categoria`:** (si no está presente) para categorizar los gastos como energía, mantenimiento, etc., para facilitar la agregación y distribución de costos.

### 5. **Nueva tabla `materiales`**

-   **Agregar una tabla `materiales`:** donde se registren todos los materiales utilizados en las impresiones, con columnas como `id_material`, `nombre`, `costo_por_unidad`, y `unidad_de_medida`. Esto permitirá relacionar las impresiones con los materiales utilizados.
-   **Tabla intermedia `impresion_material`:** Para manejar una relación muchos a muchos entre `impresiones` y `materiales`. Esta tabla podría incluir `id_impresion`, `id_material`, `cantidad_usada`, y `costo`.

### 6. **Cálculos y Procedimientos**

-   **Agregar triggers o stored procedures:** para actualizar automáticamente el costo total de la impresión (`costo_total`) cada vez que se actualicen las horas de impresión, el material utilizado, el trabajador asignado, etc.

### 7. **Relaciones**

-   **Relacionar `impresiones` con `materiales`:** A través de la tabla intermedia `impresion_material`, para poder calcular los costos de los materiales de forma precisa.

### 8. **Consulta de los Costos**

-   **Crear una vista o un reporte:** Que consolide los costos de impresión por máquina, trabajador, materiales, y desperdicio para facilitar la revisión y análisis.

### 9. **Optimización**

-   **Índices en columnas clave:** Asegúrate de que las columnas que participarán en las consultas y cálculos frecuentes tengan índices para mejorar el rendimiento de las consultas.
