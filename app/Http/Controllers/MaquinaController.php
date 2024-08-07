<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use Illuminate\Http\Request;

class MaquinaController extends Controller
{
    public function index()
    {
        $maquinas = Maquina::all();
        return view('maquinas.index', compact('maquinas'));
    }

    public function create()
    {
        return view('maquinas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha_compra' => 'required|date',
            'vida_util_anios' => 'required|integer',
            'costo' => 'required|numeric',
            'intervalo_servicio_horas' => 'required|integer',
            'costo_servicio' => 'required|numeric',
        ]);

        Maquina::create($request->all());

        return redirect()->route('maquinas.index')
                         ->with('success', 'Máquina creada exitosamente.');
    }

    public function show(Maquina $maquina)
    {
        return view('maquinas.show', compact('maquina'));
    }

    public function edit(Maquina $maquina)
    {
        return view('maquinas.edit', compact('maquina'));
    }

    public function update(Request $request, Maquina $maquina)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha_compra' => 'required|date',
            'vida_util_anios' => 'required|integer',
            'costo' => 'required|numeric',
            'intervalo_servicio_horas' => 'required|integer',
            'costo_servicio' => 'required|numeric',
        ]);

        $maquina->update($request->all());

        return redirect()->route('maquinas.index')
                         ->with('success', 'Máquina actualizada exitosamente.');
    }

    public function destroy(Maquina $maquina)
    {
        $maquina->delete();

        return redirect()->route('maquinas.index')
                         ->with('success', 'Máquina eliminada exitosamente.');
    }
}