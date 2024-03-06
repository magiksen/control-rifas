<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $participantes = Participante::all();

        return view('admin.participante.index', compact('participantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.participante.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $participante = new Participante;
        $participante->nombre = $request->nombre;
        $participante->apellido = $request->apellido;
        $participante->cedula = $request->cedula;
        $participante->correo = $request->correo;
        $participante->telefono = $request->telefono;

        $participante->save();
        
        return view('admin.participante.show', ['participante' => $participante])->with('success', 'Participante creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participante $participante)
    {
        $participante = Participante::where('id', $participante->id)->first();

        return view('admin.participante.show', ['participante' => $participante]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participante $participante)
    {
        $participante = Participante::where('id', $participante->id)->first();

        return view('admin.participante.edit', ['participante' => $participante]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participante $participante)
    {
        $affected = DB::table('participantes')
              ->where('id', $participante->id)
              ->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => $request->cedula,
                'correo' => $request->correo,
                'telefono' => $request->telefono
            ]);
        
            return Redirect()->back()->with('success', 'Participante actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participante $participante)
    {
        //
    }
}
