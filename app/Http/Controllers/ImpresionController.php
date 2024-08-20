<?php

namespace App\Http\Controllers;

use App\Models\Impresion;
use App\Models\Trabajador;
use App\Models\Maquina;

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
        return view('impresiones.create', compact('trabajadores', 'maquinas'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
    
        $request->validate([
            'id_maquina' => 'required',
            'id_trabajador' => 'required',
            'fecha_inicio' => 'required|date',
            'horas_impresion' => 'required|integer',
            'dimension_x' => 'required|numeric',
            'dimension_y' => 'required|numeric',
            'dimension_z' => 'required|numeric',
        ]);
    
        Impresion::create($request->all());
    
        return redirect()->route('impresiones.index')->with('success', 'Impresión creada con éxito.');
    }

    public function show(Impresion $impresion)
    {
        return view('impresiones.show', compact('impresion'));
    }

    public function edit(Impresion $impresion)
    {
        return view('impresiones.edit', compact('impresion'));
    }

    public function update(Request $request, Impresion $impresion)
    {
        $request->validate([
            'id_maquina' => 'required|exists:maquinas,id_maquina',
            'id_trabajador' => 'required|exists:trabajadores,id_trabajador',
            'fecha_inicio' => 'required|date',
            'horas_impresion' => 'required|integer',
            'dimension_x' => 'required|numeric',
            'dimension_y' => 'required|numeric',
            'dimension_z' => 'required|numeric',
        ]);

        $impresion->update($request->all());

        return redirect()->route('impresiones.index')->with('success', 'Impresión actualizada con éxito.');
    }

    public function destroy(Impresion $impresion)
    {
        $impresion->delete();

        return redirect()->route('impresiones.index')->with('success', 'Impresión eliminada con éxito.');
    }
}