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

    // ROLES

    public function roles() {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function addrole() {

        return view('admin.roles.create');
    }

    public function storerole(Request $request) {

        $roles = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role creado correctamente',
            'alert-type' => 'success'
        );
        
        return redirect()->route('roles')->with($notification);

    }

    public function editrole($id) {

        $role = Role::findOrFail($id);

        return view('admin.roles.edit', ['role' => $role]);
    }

    public function updaterole(Request $request, $id) {
        
        Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);
      
        $notification = array(
            'message' => 'Role actualizado correctamente',
            'alert-type' => 'success'
        );

      return Redirect()->route('roles')->with($notification);
    }

}
