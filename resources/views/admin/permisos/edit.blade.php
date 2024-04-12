@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Editar Permiso</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Permiso</a></li>
                                <li class="breadcrumb-item active">Editar</li>
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

                            <h4 class="card-title">Datos del permiso</h4>
                            <p class="card-title-desc">Ingresa los datos del Permiso</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('update.permiso', $permiso->id) }}">
                                @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Permiso" id="name" name="name" value="{{ $permiso->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="group_name" class="col-sm-2 col-form-label">Grupo</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="group_name" id="group_name">
                                        <option value="Participantes" {{ $permiso->group_name == 'Participantes' ? 'selected': '' }}>Participantes</option>
                                        <option value="Vendedores" {{ $permiso->group_name == 'Vendedores' ? 'selected': '' }}>Vendedores</option>
                                        <option value="Tickets" {{ $permiso->group_name == 'Tickets' ? 'selected': '' }}>Tickets</option>
                                        <option value="Reportes" {{ $permiso->group_name == 'Reportes' ? 'selected': '' }}>Reportes</option>
                                        <option value="Opciones" {{ $permiso->group_name == 'Opciones' ? 'selected': '' }}>Opciones</option>
                                        <option value="Roles y Permisos" {{ $permiso->group_name == 'Roles y Permisos' ? 'selected': '' }}>Roles y Permisos</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Editar</button>
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
