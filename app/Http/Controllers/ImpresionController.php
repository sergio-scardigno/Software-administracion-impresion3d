<?php

namespace App\Http\Controllers;

use App\Models\Impresion;
use App\Models\Trabajador;
use App\Models\Maquina;
use App\Models\Material;
use App\Models\Salario;
use App\Models\GastoFijo;
use Illuminate\Http\Request;

use App\Models\ImpresionMaquinaTrabajador;
use App\Models\ImpresionMaterial;

class ImpresionController extends Controller
{
    public function index()
    {
        $impresiones = Impresion::all();
        return view('impresiones.index', compact('impresiones'));
    }

    public function create()
    {
        $trabajadores = Trabajador::all();
        $maquinas = Maquina::all();
        $materiales = Material::all(); // Obtener todos los materiales
        $salarios = Salario::all();
        $gastosfijos = GastoFijo::all();

        return view('impresiones.create', compact('trabajadores', 'maquinas', 'materiales', 'salarios', 'gastosfijos'));
    }

    public function store(Request $request)
    {
        // Paso 1: Verificar datos recibidos
        // dd($request->all()); // Descomentar esta línea si necesitas verificar los datos recibidos
    
        // Paso 2: Validación de datos
        $validatedData = $request->validate([
            'id_maquina' => 'required|array',
            'id_maquina.*' => 'exists:maquinas,id_maquina',
    
            'id_trabajador' => 'required|array',
            'id_trabajador.*' => 'exists:trabajadores,id_trabajador',
    
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'horas_impresion' => 'required|integer',
            'dimension_x' => 'required|numeric',
            'dimension_y' => 'required|numeric',
            'dimension_z' => 'required|numeric',
            'cantidad_unidades' => 'required|numeric',
            'venta' => 'required|numeric',
            'desperdicio' => 'required|numeric',
            'precio_venta' => 'nullable|numeric',
    
            'materiales' => 'required|array',
            'materiales.*.id_material' => 'required|exists:materiales,id_material',
            'materiales.*.cantidad_usada' => 'required|numeric',
            'materiales.*.costo' => 'required|numeric',
        ]);
    
        // Paso 3: Verificar datos validados
        // dd($validatedData);
    
        // Crear la nueva impresión
        $impresion = new Impresion();
        $impresion->id_maquina = $validatedData['id_maquina'][0];
        $impresion->id_trabajador = $validatedData['id_trabajador'][0];
        $impresion->fecha_inicio = $validatedData['fecha_inicio'];
        $impresion->fecha_fin = $validatedData['fecha_fin'];
        $impresion->horas_impresion = $validatedData['horas_impresion'];
        $impresion->dimension_x = $validatedData['dimension_x'];
        $impresion->dimension_y = $validatedData['dimension_y'];
        $impresion->dimension_z = $validatedData['dimension_z'];
        $impresion->desperdicio = $validatedData['desperdicio'];
        $impresion->cantidad_unidades = $validatedData['cantidad_unidades'];
        $impresion->venta = $validatedData['venta'];

        // Asignar valores predeterminados
        $impresion->costo_desperdicio = 0; // O asigna un valor calculado
        $impresion->costo_total = 0; // O asigna un valor calculado

        // Calcular el costo de los materiales
        $costoMateriales = 0;
        foreach ($validatedData['materiales'] as $materialData) {
            $material = Material::find($materialData['id_material']);
            $costoMaterial = $material->costo_por_unidad * $materialData['cantidad_usada'];
            $costoMateriales += $costoMaterial;
        }
        $impresion->costo_materiales = $costoMateriales;

        // Asignar el costo total (aquí podrías hacer una suma de todos los costos si es necesario)
        $impresion->costo_total = $costoMateriales + $impresion->costo_desperdicio; // Ejemplo de cálculo de costo total

        // Guardar la impresión para obtener el ID
        $impresion->save();

    
        // Paso 6: Verificar si la impresión se guardó correctamente
        // dd($impresion);
    
        // Asociar materiales con la impresión
        foreach ($validatedData['materiales'] as $materialData) {
            // Paso 7: Verificar datos de cada material
            // dd($materialData);
    
            $impresionMaterial = new ImpresionMaterial();
            $impresionMaterial->id_impresion = $impresion->id_impresion;
            $impresionMaterial->id_material = $materialData['id_material'];
            $impresionMaterial->cantidad_usada = $materialData['cantidad_usada'];
            $impresionMaterial->costo = Material::find($materialData['id_material'])->costo_por_unidad * $materialData['cantidad_usada'];
            $impresionMaterial->save();
        }
    
        // Asociar la máquina y trabajador con la impresión
        foreach ($validatedData['id_maquina'] as $id_maquina) {
            foreach ($validatedData['id_trabajador'] as $id_trabajador) {
                $impresionMaquinaTrabajador = new ImpresionMaquinaTrabajador();
                $impresionMaquinaTrabajador->id_impresion = $impresion->id_impresion;
                $impresionMaquinaTrabajador->id_maquina = $id_maquina;
                $impresionMaquinaTrabajador->id_trabajador = $id_trabajador;
                $impresionMaquinaTrabajador->save();
            }
        }
    
        // Redireccionar con un mensaje de éxito
        return redirect()->route('impresiones.index')->with('success', 'Impresión creada exitosamente.');
    }
    

    public function show($id)
    {
        $impresion = Impresion::with('materiales', 'maquinas', 'trabajadores')->findOrFail($id);

        return view('impresiones.show', compact('impresion'));
    }

    public function edit(Impresion $impresion)
    {
        $trabajadores = Trabajador::all();
        $maquinas = Maquina::all();
        $materiales = Material::all(); // Obtener todos los materiales
        $impresion->load('materiales', 'maquinas', 'trabajadores'); // Cargar las relaciones actuales

        return view('impresiones.edit', compact('impresion', 'trabajadores', 'maquinas', 'materiales'));
    }

    public function update(Request $request, Impresion $impresion)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'horas_impresion' => 'required|integer',
            'dimension_x' => 'required|numeric',
            'dimension_y' => 'required|numeric',
            'dimension_z' => 'required|numeric',
            'desperdicio' => 'required|numeric',
            'cantidad_unidades' => 'required|numeric',
            'venta' => 'required|numeric',
            'precio_venta' => 'nullable|numeric',
            'maquinas' => 'required|array',
            'maquinas.*' => 'exists:maquinas,id_maquina',
            'trabajadores' => 'required|array',
            'trabajadores.*' => 'exists:trabajadores,id_trabajador',
            'materiales' => 'required|array',
            'materiales.*.id_material' => 'required|exists:materiales,id_material',
            'materiales.*.cantidad_usada' => 'required|numeric',
            'materiales.*.costo' => 'required|numeric',
        ]);

        $impresion->update($request->all());

        // Sincronizar máquinas y trabajadores asociados con la impresión
        $impresion->maquinas()->sync($request->maquinas);
        $impresion->trabajadores()->sync($request->trabajadores);

        // Sincronizar materiales asociados con la impresión
        $syncData = [];
        foreach ($request->materiales as $materialData) {
            $syncData[$materialData['id_material']] = [
                'cantidad_usada' => $materialData['cantidad_usada'],
                'costo' => $materialData['costo'],
            ];
        }
        $impresion->materiales()->sync($syncData);

        return redirect()->route('impresiones.index')->with('success', 'Impresión actualizada con éxito.');
    }

    public function destroy(Impresion $impresion)
    {
        $impresion->delete();

        return redirect()->route('impresiones.index')->with('success', 'Impresión eliminada con éxito.');
    }
}