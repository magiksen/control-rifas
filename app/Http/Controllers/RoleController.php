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
}
