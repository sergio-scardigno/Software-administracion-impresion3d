<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class MaterialController extends Controller
{
    public function index()
    {
        $materiales = Material::all();
        $precios = $this->obtenerPrecios();
        
        
        return view('materiales.index', compact('materiales', 'precios'));


    }

    public function create()
    {
        $precios = $this->obtenerPrecios();

        return view('materiales.create', compact('precios'));
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

    public function obtenerPrecios()
    {
        // URL de la API
        $url = 'https://insumos-3d-api.vercel.app/precios?presentacion=1KG';
    
        // Realizar la solicitud GET a la API y almacenar la respuesta en una variable
        $response = Http::get($url);
    
        // Depurar la respuesta
        if ($response->successful()) {
            // Mostrar la respuesta en un log para verificar la estructura
            Log::info($response->json());
            
            // Retornar el JSON de la respuesta
            return $response->json();
        } else {
            // Log de error en caso de fallo
            Log::error('Error al obtener los precios: ' . $response->status());
            
            // Manejar el error y retornar null
            return null;
        }
    }
}