@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Roles y Permisos</h4>

                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ route('crear.rol') }}" class="btn btn-primary">Agregar Roles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Lista de roles</h4>
                            <p class="card-title-desc">Visualizar la lista de roles</p>

                            <div class="table-responsive">
                                <table id="datatable" class="table mb-0">
        
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $key => $role)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $role->name}}</td>
                                            <td>
                                                <a href="{{ route('editar.roles.permisos', $role->id ) }}"><i class="ri-eye-line"></i></a>
                                                <a href="{{ route('editar.rol', $role->id ) }}"><i class="ri-edit-line"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach      
                                    </tbody>
                                </table>
                            </div>
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
