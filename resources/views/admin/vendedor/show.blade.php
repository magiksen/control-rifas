@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ver Vendedor</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendedor</a></li>
                                <li class="breadcrumb-item active">Ver</li>
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

                            <h4 class="card-title">Datos del vendedor</h4>
                            <p class="card-title-desc">Visualizar los datos del vendedor</p>
                            
                            <div class="row mb-3">
                               <p>Nombre: {{ $vendedor->nombre }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Apellido: {{ $vendedor->apellido }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Cedula: {{ $vendedor->cedula }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Telefono: {{ $vendedor->telefono }}</p>
                            </div>
                            <!-- end row -->
                            <a href="{{ route('vendedor.edit',$vendedor->id) }}" class="btn btn-primary">Editar</a>
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
