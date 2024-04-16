@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Agregar Rol en Permiso</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Rol en permiso</a></li>
                                <li class="breadcrumb-item active">Crear</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Datos del Rol</h4>
                            <p class="card-title-desc">Seleccionar datos</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('store.role.permission') }}">
                                @csrf
                            <div class="row mb-3">
                                <label for="role_id" class="col-sm-2 col-form-label">Rol</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="role_id" id="role_id">
                                        <option selected="">Elije un grupo</option>
                                        @foreach ( $roles as $role )
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach      
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="permisosall">
                                        <label class="form-check-label" for="permisosall">
                                            Seleccionar todo
                                        </label>
                                    </div>
                                </div>
                            </div>    
                            <hr>
                            @foreach ( $permission_groups as $group )
                            <div class="row mb-3">
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                        <label class="form-check-label" for="formCheck1">
                                            {{ $group->group_name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-9">
                                    @php
                                        $permissions = App\Models\User::getpermissionByGroupName($group->group_name)
                                    @endphp
                                    @foreach ( $permissions as $permission )
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="permission[]" value="{{ $permission->id }}" type="checkbox" id="formCheck1{{ $permission->id }}">
                                        <label class="form-check-label" for="formCheck1{{ $permission->id }}">
                                        {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            <button class="btn btn-primary" type="submit">Crear</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div><!-- end row -->


            <!-- end row -->
        </div>
        <!-- end row -->
    </div>

    </div>


@endsection