<?php

namespace App\Http\Controllers;

use App\Models\Impresion;
use App\Models\Trabajador;
use App\Models\Maquina;
use App\Models\Material;
use App\Models\Salario;
use App\Models\GastoFijo;
use Illuminate\Http\Request;

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

        $impresion = Impresion::create($request->all());

        // Asociar máquinas y trabajadores a la impresión
        $impresion->maquinas()->attach($request->maquinas);
        $impresion->trabajadores()->attach($request->trabajadores);

        // Asociar materiales con la impresión
        foreach ($request->materiales as $materialData) {
            $impresion->materiales()->attach($materialData['id_material'], [
                'cantidad_usada' => $materialData['cantidad_usada'],
                'costo' => $materialData['costo'],
            ]);
        }

        return redirect()->route('impresiones.index')->with('success', 'Impresión creada con éxito.');
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