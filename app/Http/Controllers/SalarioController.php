<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salario;

class SalarioController extends Controller
{
    public function index()
    {
        $salarios = Salario::all();
        return view('salarios.index', compact('salarios'));
    }

    public function create()
    {
        return view('salarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_trabajador' => 'required',
            'salario_mensual' => 'required|numeric',
        ]);

        Salario::create($request->all());

        return redirect()->route('salarios.index')
                         ->with('success', 'Salario creado exitosamente.');
    }

    public function show(Salario $salario)
    {
        return view('salarios.show', compact('salario'));
    }

    public function edit($id)
    {
        $salario = Salario::find($id);
        return view('salarios.edit', compact('salario'));
    }

    public function update(Request $request, Salario $salario)
    {
        // dd($salario);

        $request->validate([
            'tipo_trabajador' => 'required',
            'salario_mensual' => 'required|numeric',
        ]);

        // dd($request);
    
        $salario->update(array_merge($salario->toArray(), $request->all()));
    
        // dd( $salario);

        return redirect()->route('salarios.index')
                         ->with('success', 'Salario actualizado exitosamente.');
    }

    public function destroy(Salario $salario)
    {
        $salario->delete();

        return redirect()->route('salarios.index')
                         ->with('success', 'Salario eliminado exitosamente.');
    }
}