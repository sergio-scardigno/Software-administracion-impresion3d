<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function index()
    {
        $modelos = Modelo::all();
        return view('modelos.index', compact('modelos'));
    }

    public function create()
    {
        return view('modelos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dimension_x' => 'required|numeric',
            'dimension_y' => 'required|numeric',
            'dimension_z' => 'required|numeric',
            'horas_estimadas' => 'required|integer',
        ]);

        Modelo::create($request->all());

        return redirect()->route('modelos.index')
                        ->with('success', 'Modelo creado con éxito.');
    }

    public function show($id)
    {
        $modelo = Modelo::findOrFail($id);
        return view('modelos.show', compact('modelo'));
    }

    public function edit($id)
    {
        $modelo = Modelo::findOrFail($id);
        return view('modelos.edit', compact('modelo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dimension_x' => 'required|numeric',
            'dimension_y' => 'required|numeric',
            'dimension_z' => 'required|numeric',
            'horas_estimadas' => 'required|integer',
        ]);

        $modelo = Modelo::findOrFail($id);
        $modelo->update($request->all());

        return redirect()->route('modelos.index')
                        ->with('success', 'Modelo actualizado con éxito.');
    }

    public function destroy($id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->delete();

        return redirect()->route('modelos.index')
                        ->with('success', 'Modelo eliminado con éxito.');
    }
}