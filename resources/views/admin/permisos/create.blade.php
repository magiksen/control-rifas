@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Crear Permiso</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Permiso</a></li>
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
                            <form method="post" action="{{ route('store.permiso') }}">
                                @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Permiso" id="name" name="name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="group_name" class="col-sm-2 col-form-label">Grupo</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="group_name" id="group_name">
                                        <option selected="">Elije un grupo</option>
                                        <option value="Participantes">Participantes</option>
                                        <option value="Vendedores">Vendedores</option>
                                        <option value="Tickets">Tickets</option>
                                        <option value="Reportes">Reportes</option>
                                        <option value="Opciones">Opciones</option>
                                        <option value="Roles y Permisos">Roles y Permisos</option>
                                        <option value="Mensajes">Mensajes</option>
                                    </select>
                                </div>
                            </div>
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
