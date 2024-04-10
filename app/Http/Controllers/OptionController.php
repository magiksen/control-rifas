<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $opciones = DB::table('variables')->get();

        return view('admin.opciones.index', ['opciones' => $opciones]);
    }

    public function edit($id)
    {
        $opcion = DB::table('variables')->where('id', $id)->first();

        return view('admin.opciones.edit', ['opcion' => $opcion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $affected = DB::table('variables')
              ->where('id', $id)
              ->update([
                'valor' => $request->valor,
            ]);
            
            $notification = array(
                'message' => 'Opción actualizada correctamente',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);

    }

}
