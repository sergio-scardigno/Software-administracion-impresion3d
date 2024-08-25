<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materiales = Material::all();
        return view('materiales.index', compact('materiales'));
    }

    public function create()
    {
        return view('materiales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'costo_por_unidad' => 'required|numeric',
            'unidad_de_medida' => 'required|string|max:50',
            'cantidad_de_material' => 'required|numeric'
        ]);

        Material::create($request->all());

        return redirect()->route('materiales.index')
                         ->with('success', 'Material creado exitosamente.');
    }

    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('materiales.show', compact('material'));
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('materiales.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'costo_por_unidad' => 'required|numeric',
            'unidad_de_medida' => 'required|string|max:50',
            'cantidad_de_material' => 'required|numeric'
        ]);

        $material->update($request->all());

        return redirect()->route('materiales.index')
                         ->with('success', 'Material actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materiales.index')
                         ->with('success', 'Material eliminado exitosamente.');
    }

    public function obtenerDatos($id)
    {
        $material = Material::find($id);

        if ($material) {
            return response()->json([
                'id' => $material->id_material,
                'nombre' => $material->nombre,
                'costo_por_unidad' => $material->costo_por_unidad,
                'unidad_de_medida' => $material->unidad_de_medida,
                'cantidad_de_material' => $material->cantidad_de_material,
            ]);
        } else {
            return response()->json(['error' => 'Máquina no encontrada'], 404);
        }
    }
}