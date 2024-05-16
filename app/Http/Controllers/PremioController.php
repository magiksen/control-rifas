<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use Illuminate\Http\Request;

class PremioController extends Controller
{
    public function index() {
        $premios = Premio::all();

        return view('admin.premios.index', compact('premios'));
    }

    public function create() {

        return view('admin.premios.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);
        $premio = new Premio();
        $premio->nombre = $request->input('nombre');
        $premio->loteria = $request->input('loteria');
        $premio->hora = $request->input('hora');
        $premio->numero = $request->input('numero');
        $premio->save();

        $notification = array(
            'message' => 'Premio creado correctamente',
            'alert-type' => 'success'
        );
        return redirect()->route('premios.index')->with($notification);
    }

    public function edit($id) {

        $premio = Premio::findOrFail($id);

        return view('admin.premios.edit', compact('premio'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
        ]);

        Premio::findOrFail($id)->update([
            'nombre' => $request->nombre,
            'loteria' => $request->loteria,
            'hora' => $request->hora,
            'numero' => $request->numero
        ]);

        $notification = array(
            'message' => 'Premio actualizado correctamente',
            'alert-type' => 'success'
        );
        return redirect()->route('premios.index')->with($notification);
    }
    public function destroy($id) {
        $premio = Premio::where('id', $id)->delete();

        $notification = array(
            'message' => 'Premio eliminado correctamente',
            'alert-type' => 'success'
        );
        return redirect()->route('premios.index')->with($notification);
    }

    public function ganadores() {
        $premios = Premio::all();
        //dd($premios);
        return view('admin.premios.results', compact('premios'));
    }
}
