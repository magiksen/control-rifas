@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ver Participante</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Participante</a></li>
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

                            <h4 class="card-title">Datos del participante</h4>
                            <p class="card-title-desc">Visualizar los datos del participante</p>
                            
                            <div class="row mb-3">
                               <p>Nombre: {{ $participante->nombre }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Apellido: {{ $participante->apellido }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Cedula: {{ $participante->cedula }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Correo: {{ $participante->correo }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Telefono: {{ $participante->telefono }}</p>
                            </div>
                            <!-- end row -->
                            <a href="{{ route('participante.edit',$participante->id) }}" class="btn btn-primary">Editar</a>
                        </div>
                    </div>
                </div>

            </div><!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Tickets</h4>
                            <p class="card-title-desc">Tickets del participante</p>
                            
                            <div class="row mb-3">
                               <p>Numero: 999</p>
                            </div>
                            <div class="row mb-3">
                                <p>Aqui va la imagen del ticket, boton de enviar ticket por ws</p>
                            </div>
                            <!-- end row -->
                            <a href="#" class="btn btn-primary">Registrar Ticket</a>
                        </div>
                    </div>
                </div>

            </div><!-- end 


            <!-- end row -->
        </div>
        <!-- end row -->
    </div>

    </div>

@endsection
