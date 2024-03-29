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
        $paises = DB::table('paises')->get();

        return view('admin.participante.create', ['paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
        ]);

        $participante = new Participante;
        $participante->nombre = $request->nombre;
        $participante->apellido = $request->apellido;
        $participante->cedula = $request->cedula;
        $participante->correo = $request->correo;
        $participante->telefono = $request->telefono;
        $participante->pais = $request->pais;

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

        $paises = DB::table('paises')->get();

        $pais_selected = DB::table('paises')
        ->where('pais_numero', '=', $participante->pais)
        ->first();

        return view('admin.participante.edit', ['participante' => $participante, 'paises' => $paises, 'pais_selected' => $pais_selected]);
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
                'telefono' => $request->telefono,
                'pais' => $request->pais
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
    public function destroy($id)
    {   
        $participante = Participante::where('id', $id)->delete();

        $notification = array(
            'message' => 'Participante eliminado correctamente',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}
