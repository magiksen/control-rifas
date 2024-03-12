<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|unique:participantes|max:255',
            'correo' => 'required',
            'telefono' => 'required',
        ]);

        $participante = new Participante;
        $participante->nombre = $request->nombre;
        $participante->apellido = $request->apellido;
        $participante->cedula = $request->cedula;
        $participante->correo = $request->correo;
        $participante->telefono = $request->telefono;

        $participante->save();

        $notification = array(
            'message' => 'Participante creado correctamente',
            'alert-type' => 'success'
        );
        
        return view('admin.participante.show', ['participante' => $participante])->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $participante = Participante::where('id', $id)->first();

        return view('admin.participante.show', ['participante' => $participante]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $participante = Participante::where('id', $id)->first();

        return view('admin.participante.edit', ['participante' => $participante]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $affected = DB::table('participantes')
              ->where('id', $id)
              ->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => $request->cedula,
                'correo' => $request->correo,
                'telefono' => $request->telefono
            ]);

            $notification = array(
                'message' => 'Participante actualizado correctamente',
                'alert-type' => 'success'
            );
        
            return Redirect()->back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participante $participante)
    {
        //
    }
}
