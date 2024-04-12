<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function permisos() {
        $permisos = Permission::all();

        return view('admin.permisos.index', compact('permisos'));
    }

    public function crearpermiso() {

        return view('admin.permisos.create');
    }

    public function storepermiso(Request $request) {

        $roles = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permiso creado correctamente',
            'alert-type' => 'success'
        );
        
        return redirect()->route('permisos')->with($notification);

    }
    
    public function editpermiso($id) {

        $permiso = Permission::where('id', $id)->first();

        return view('admin.permisos.edit', ['permiso' => $permiso]);
    }

    public function updatepermiso(Request $request, $id) {
        
        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);
      
        $notification = array(
            'message' => 'Permiso actualizado correctamente',
            'alert-type' => 'success'
        );

      return Redirect()->route('permisos')->with($notification);
    }
}
