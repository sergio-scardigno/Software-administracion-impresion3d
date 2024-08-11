<?php
namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\Salario;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function index()
    {
        $trabajadores = Trabajador::all();
        $salarios = Salario::all();
        
        return view('trabajadores.index', compact('trabajadores', 'salarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|exists:salarios,id', // Validar que tipo sea un ID válido en la tabla salarios
            'salario_id' => 'required|exists:salarios,id', // Validar que salario_id sea un ID válido en la tabla salarios
        ]);

        Trabajador::create($request->all());

        return redirect()->route('trabajadores.index')
                         ->with('success', 'Trabajador creado exitosamente.');
    }

    public function show(Trabajador $trabajador)
    {
        return view('trabajadores.show', compact('trabajador'));
    }

    public function edit(Trabajador $trabajador)
    {
        $salarios = Salario::all();
        return view('trabajadores.edit', compact('trabajador', 'salarios'));
    }

    public function update(Request $request, Trabajador $trabajador)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|exists:salarios,id', // Validar que tipo sea un ID válido en la tabla salarios
            'salario_id' => 'required|exists:salarios,id', // Validar que salario_id sea un ID válido en la tabla salarios
        ]);

        $trabajador->update($request->all());

        return redirect()->route('trabajadores.index')
                         ->with('success', 'Trabajador actualizado exitosamente.');
    }

    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();

        return redirect()->route('trabajadores.index')
                         ->with('success', 'Trabajador eliminado exitosamente.');
    }
}