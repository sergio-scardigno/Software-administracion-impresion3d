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
            'tipo' => 'required|exists:salarios,id', 
            'salario_id' => 'required|exists:salarios,id', 
        ]);

        // Obtener el salario mensual del ID proporcionado
        $salario = Salario::find($request->salario_id);
        if (!$salario) {
            return redirect()->back()->withErrors(['salario_id' => 'El salario seleccionado no es válido.']);
        }

        // Calcular el costo por hora basado en el salario mensual
        $horas_trabajadas_por_mes = 160; // 40 horas por semana * 4 semanas
        $costo_por_hora = $salario->salario_mensual / $horas_trabajadas_por_mes;

        // dd($costo_por_hora);

        // Crear un nuevo trabajador con el costo por hora calculado
        Trabajador::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'salario_id' => $request->salario_id,
            'costo_por_hora' => $costo_por_hora,
        ]);

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
            'tipo' => 'required|exists:salarios,id',
            'salario_id' => 'required|exists:salarios,id',
        ]);
    
        // Obtener el salario mensual del ID proporcionado
        $salario = Salario::find($request->salario_id);
        if (!$salario) {
            return redirect()->back()->withErrors(['salario_id' => 'El salario seleccionado no es válido.']);
        }
    
        // Calcular el costo por hora basado en el salario mensual
        $horas_trabajadas_por_mes = 160; // 40 horas por semana * 4 semanas
        $costo_por_hora = $salario->salario_mensual / $horas_trabajadas_por_mes;
    
        // Actualizar el trabajador con el costo por hora calculado
        $trabajador->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'salario_id' => $request->salario_id,
            'costo_por_hora' => $costo_por_hora,
        ]);
    
        return redirect()->route('trabajadores.index')
                         ->with('success', 'Trabajador actualizado exitosamente.');
    }
    

    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();

        return redirect()->route('trabajadores.index')
                         ->with('success', 'Trabajador eliminado exitosamente.');
    }

    public function obtenerDatos($id)
    {
        $trabajador = Trabajador::find($id);

        if ($trabajador) {
            return response()->json([
                'trabajador_id' => $trabajador->id_trabajador,
                'trabajador_nombre' => $trabajador->nombre,
                'costo_por_hora' => $trabajador->costo_por_hora
            ]);
        } else {
            return response()->json(['error' => 'Trabajador no encontrado'], 404);
        }
    }
}