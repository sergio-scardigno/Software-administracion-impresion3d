<?php
namespace App\Http\Controllers;

use App\Models\GastoFijo;
use Illuminate\Http\Request;

class GastoFijoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastosFijos = GastoFijo::all();
        return view('gastos_fijos.index', compact('gastosFijos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gastos_fijos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_gasto' => 'required|string|max:255',
            'monto' => 'required|numeric',
        ]);

        GastoFijo::create($request->all());

        return redirect()->route('gastos_fijos.index')
                         ->with('success', 'Gasto fijo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gastoFijo = GastoFijo::findOrFail($id);

        return view('gastos_fijos.show', compact('gastoFijo'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $gastos = GastoFijo::latest()->take(10)->get();
        // Busca el gasto por su ID. Si no existe, fallará y mostrará un error 404.
        $gastoFijo = GastoFijo::findOrFail($id);

        // Pasamos el gasto a la vista para que se puedan editar sus detalles.
        // Asegúrate de tener una vista 'gastos.edit' que reciba este gasto y muestre el formulario de edición.
        return view('gastos_fijos.edit', compact('gastoFijo', 'gastos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GastoFijo $gastoFijo)
    {
        $request->validate([
            'tipo_gasto' => 'required|string|max:255',
            'monto' => 'required|numeric',
        ]);

        $gastoFijo->update($request->all());

        return redirect()->route('gastos_fijos.index')
                         ->with('success', 'Gasto fijo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $gasto = GastoFijo::findOrFail($id); 
        $gasto->delete();
        
        return redirect()->route('gastos_fijos.index')
                         ->with('success', 'Gasto fijo eliminado exitosamente.');
    }
}