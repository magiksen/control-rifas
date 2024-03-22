@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Opciones</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Opciones</a></li>
                                <li class="breadcrumb-item active">Generales</li>
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

                            <h4 class="card-title">Lista de opciones</h4>
                            <p class="card-title-desc">Visualizar la lista de opciones</p>

                            <div class="table-responsive">
                                <table class="table mb-0">
        
                                    <thead class="table-light">
                                        <tr>
                                            <th>Opción</th>
                                            <th>Valor</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($opciones as $opcion)
                                        <tr>
                                            <td>{{ $opcion->opcion}}</td>
                                            <td>{{ $opcion->valor }}</td>
                                            <td>
                                                <a href="{{ route('opcion.edit',$opcion->id) }}"><i class="ri-edit-line"></i></a>
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
