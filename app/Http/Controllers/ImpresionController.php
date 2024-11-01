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

use Illuminate\Support\Carbon;

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
        //dd($request->all()); // Descomentar esta línea si necesitas verificar los datos recibidos
    
        // Paso 2: Validación de datos
        $validatedData = $request->validate([
            'id_maquina' => 'required|array',
            'id_maquina.*' => 'exists:maquinas,id_maquina',
    
            'id_trabajador' => 'required|array',
            'id_trabajador.*' => 'exists:trabajadores,id_trabajador',
    
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',

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
        //dd($validatedData);
    
        // Crear la nueva impresión
        $impresion = new Impresion();
        $impresion->id_maquina = $validatedData['id_maquina'][0];
        $impresion->id_trabajador = $validatedData['id_trabajador'][0];
        

        // Asignar la fecha de inicio como el momento actual en el formato adecuado
        $impresion->fecha_inicio = Carbon::now()->format('Y-m-d H:i:s');

        // Asegurarte de que horas_impresion es un número
        $horasImpresion = (int) $validatedData['horas_impresion'];

        // Calcular la fecha de fin sumando las horas de impresión a la fecha de inicio
        $impresion->fecha_fin = Carbon::parse($impresion->fecha_inicio)
            ->addHours($horasImpresion)
            ->format('Y-m-d H:i:s');

        $impresion->horas_impresion = $validatedData['horas_impresion'];
        $impresion->dimension_x = $validatedData['dimension_x'];
        $impresion->dimension_y = $validatedData['dimension_y'];
        $impresion->dimension_z = $validatedData['dimension_z'];
        $impresion->desperdicio = $validatedData['desperdicio'];
        $impresion->cantidad_unidades = $validatedData['cantidad_unidades'];
        $impresion->venta = $validatedData['venta'];

        // Asignar valores predeterminados
        $impresion->costo_desperdicio = 0; // Inicializar el costo del desperdicio
        $impresion->costo_total = 0; // Inicializar el costo total

        // Calcular el costo de los materiales y el costo del desperdicio
        $costoMateriales = 0;
        foreach ($validatedData['materiales'] as $materialData) {
            $material = Material::find($materialData['id_material']);
            $costoMaterial = $material->costo_por_gramo * $materialData['cantidad_usada'];
            $costoMateriales += $costoMaterial;

            // Sumar el costo del desperdicio en cada iteración
            $costoDesperdicioPorMaterial = $material->costo_por_gramo * $impresion->desperdicio;
            $impresion->costo_desperdicio += $costoDesperdicioPorMaterial;
        }

        // Asignar el costo total
        $impresion->costo_materiales = $costoMateriales;
        $impresion->costo_total = $costoMateriales + $impresion->costo_desperdicio;

        // Guardar la impresión para obtener el ID
        $impresion->save();


    
        // Paso 6: Verificar si la impresión se guardó correctamente
        //dd($impresion);
    
        // Asociar materiales con la impresión
        foreach ($validatedData['materiales'] as $materialData) {
            // Paso 7: Verificar datos de cada material
            // dd($materialData);
    
            $impresionMaterial = new ImpresionMaterial();
            $impresionMaterial->id_impresion = $impresion->id_impresion;
            $impresionMaterial->id_material = $materialData['id_material'];
            $impresionMaterial->cantidad_usada = $materialData['cantidad_usada'];
            $impresionMaterial->costo = Material::find($materialData['id_material'])->costo_por_gramo * $materialData['cantidad_usada'];
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

    public function edit($id)
    {
        $impresion = Impresion::find($id);
        // Obtener todos los trabajadores, máquinas y materiales
        $trabajadores = Trabajador::all();
        $maquinas = Maquina::all();
        $materiales = Material::all();
    
        // Cargar las relaciones actuales de la impresión
        $impresion->load('materiales', 'maquinas', 'trabajadores');
    
        // Mapear los materiales asociados para que sean fácilmente manejables en la vista
        $materialesAsociados = $impresion->materiales->map(function ($material) {
            return [
                'id_material' => $material->pivot->id_material,
                'cantidad_usada' => $material->pivot->cantidad_usada,
                'costo' => $material->pivot->costo,
            ];
        });
    
        // Mapear las máquinas y trabajadores asociados para la vista
        $maquinasAsociadas = $impresion->maquinas->pluck('id_maquina')->toArray();
        $trabajadoresAsociados = $impresion->trabajadores->pluck('id_trabajador')->toArray();
    
        return view('impresiones.edit', compact(
            'impresion',
            'trabajadores',
            'maquinas',
            'materiales',
            'materialesAsociados',
            'maquinasAsociadas',
            'trabajadoresAsociados'
        ));
    }
    

    public function update(Request $request, $id)
    {
        $impresion = Impresion::findOrFail($id);
        
        // Validación de datos
        $validatedData = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
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
    
        // Actualizar los datos de la impresión
        $impresion->fecha_inicio = $validatedData['fecha_inicio'];
        $impresion->fecha_fin = $validatedData['fecha_fin'];
        $impresion->horas_impresion = $validatedData['horas_impresion'];
        $impresion->dimension_x = $validatedData['dimension_x'];
        $impresion->dimension_y = $validatedData['dimension_y'];
        $impresion->dimension_z = $validatedData['dimension_z'];
        $impresion->desperdicio = $validatedData['desperdicio'];
        $impresion->cantidad_unidades = $validatedData['cantidad_unidades'];
        $impresion->venta = $validatedData['venta'];
    
        // Recalcular el costo de los materiales y el costo del desperdicio
        $costoMateriales = 0;
        $costoDesperdicio = 0;
    
        foreach ($validatedData['materiales'] as $materialData) {
            $material = Material::find($materialData['id_material']);
            $costoMaterial = $material->costo_por_gramo * $materialData['cantidad_usada'];
            $costoMateriales += $costoMaterial;
    
            // Sumar el costo del desperdicio en cada iteración
            $costoDesperdicio += $material->costo_por_gramo * $impresion->desperdicio;
        }
    
        // Asignar los costos recalculados
        $impresion->costo_materiales = $costoMateriales;
        $impresion->costo_desperdicio = $costoDesperdicio;
        $impresion->costo_total = $costoMateriales + $costoDesperdicio;
    
        // Guardar la impresión actualizada
        $impresion->save();
    
        // Sincronizar máquinas y trabajadores asociados con la impresión
        $impresion->maquinas()->sync($validatedData['maquinas']);
        $impresion->trabajadores()->sync($validatedData['trabajadores']);
    
        // Sincronizar materiales asociados con la impresión
        $syncData = [];
        foreach ($validatedData['materiales'] as $materialData) {
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