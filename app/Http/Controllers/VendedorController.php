<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendedores = User::where('role_id', 3)->get();

        return view('admin.vendedor.index', compact('vendedores'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = DB::table('paises')->get();

        return view('admin.vendedor.create', ['paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $vendedor = new Vendedor;
        // $vendedor->nombre = $request->nombre;
        // $vendedor->apellido = $request->apellido;
        // $vendedor->cedula = $request->cedula;
        // $vendedor->telefono = $request->telefono;
        // $vendedor->pais = $request->pais;

        // $vendedor->save();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $vendedor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'pais' => $request->pais,
            'role_id' => 3
        ]);


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
        $vendedor = User::where('id', $id)->first();

        $ticketsVendidos = $vendedor->tickets->groupBy('participante_id');

        if(count($ticketsVendidos) < 1) {
            $ticketsVendidos = 0;
        }

        //dd($ticketsVendidos);

        return view('admin.vendedor.show', ['vendedor' => $vendedor, 'ticketsVendidos' => $ticketsVendidos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendedor = User::findOrFail($id);

        $paises = DB::table('paises')->get();

        $pais_selected = DB::table('paises')
        ->where('pais_numero', '=', $vendedor->pais)
        ->first();

        return view('admin.vendedor.edit', ['vendedor' => $vendedor, 'paises' => $paises, 'pais_selected' => $pais_selected]);
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
                'telefono' => $request->telefono,
                'pais' => $request->pais
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
    public function destroy($id)
    {
        $vendedor = Vendedor::where('id', $id)->delete();

        $notification = array(
            'message' => 'Vendedor eliminado correctamente',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}
