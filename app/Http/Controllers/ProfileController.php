<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile() {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        $paises = DB::table('paises')->get();

        $pais_selected = DB::table('paises')
        ->where('pais_numero', '=', $profileData->pais)
        ->first();

        return view('admin.profile.index', compact('profileData','paises','pais_selected'));
    }

    public function profileupdate(Request $request)
    {   
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'password' => ['confirmed'],
        ]);

        if(!empty($request->password)) {
            $affected = DB::table('users')
              ->where('id', $id)
              ->update([
                'name' => $request->name,
                'email' => $request->email,
                'cedula' => $request->cedula,
                'telefono' => $request->telefono,
                'pais' => $request->pais,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $affected = DB::table('users')
              ->where('id', $id)
              ->update([
                'name' => $request->name,
                'email' => $request->email,
                'cedula' => $request->cedula,
                'telefono' => $request->telefono,
                'pais' => $request->pais,
            ]);
        }
        

            $notification = array(
                'message' => 'Usuario actualizado correctamente',
                'alert-type' => 'success'
            );
        
            return Redirect()->back()->with($notification);
    }
}
