<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendedores = Vendedor::all();

        return view('admin.vendedor.index', compact('vendedores'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vendedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vendedor = new Vendedor;
        $vendedor->nombre = $request->nombre;
        $vendedor->apellido = $request->apellido;
        $vendedor->cedula = $request->cedula;
        $vendedor->telefono = $request->telefono;

        $vendedor->save();

        $notification = array(
            'message' => 'Vendedor creado correctamente',
            'alert-type' => 'success'
        );
        
        return view('admin.vendedor.show', ['vendedor' => $vendedor])->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vendedor = Vendedor::where('id', $id)->first();

        return view('admin.vendedor.show', ['vendedor' => $vendedor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendedor = Vendedor::where('id', $id)->first();

        return view('admin.vendedor.edit', ['vendedor' => $vendedor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $affected = DB::table('vendedors')
              ->where('id', $id)
              ->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => $request->cedula,
                'telefono' => $request->telefono
            ]);

            $notification = array(
                'message' => 'Vendedor actualizado correctamente',
                'alert-type' => 'success'
            );
        
            return Redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendedor $vendedor)
    {
        //
    }
}
