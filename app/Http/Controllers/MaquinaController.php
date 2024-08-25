<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use Illuminate\Http\Request;

class MaquinaController extends Controller
{
    public function index()
    {
        $maquinas = Maquina::all();

        // Añadir el cálculo del Costo por Hora para cada máquina
        foreach ($maquinas as $maquina) {
            $horas_utiles = $maquina->vida_util_anios * 365 * 24; // Asumiendo 24 horas al día y 365 días al año
            $maquina->costo_por_hora = ($maquina->costo + $maquina->costo_servicio) / $horas_utiles;
        }

        return view('maquinas.index', compact('maquinas'));
    }

    public function create()
    {
        return view('maquinas.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_compra' => 'required|date',
            'vida_util_anios' => 'required|integer',
            'costo' => 'required|numeric',
            'intervalo_servicio_horas' => 'required|integer',
            'costo_servicio' => 'required|numeric',
            'costo_mantenimiento_por_hora' => 'required|numeric',
            'horas_utilizadas' => 'nullable|integer', // Hacerlo opcional
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
            'costo_mantenimiento_por_hora' => 'required|numeric'
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


    // Tomar el costo de hora de la maquina para la funcion de JS
    public function obtenerDatos($id)
    {
        $maquina = Maquina::find($id);

        if ($maquina) {
            return response()->json([
                'costo' => $maquina->costo,
                'vida_util_anios' => $maquina->vida_util_anios
            ]);
        } else {
            return response()->json(['error' => 'Máquina no encontrada'], 404);
        }
    }

}