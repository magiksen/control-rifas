@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ver Participantes</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Participantes</a></li>
                                <li class="breadcrumb-item active">Lista</li>
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

                            <h4 class="card-title">Lista de participantes</h4>
                            <p class="card-title-desc">Visualizar la lista de participantes registrados</p>

                            <div class="table-responsive">
                                <table id="datatable" class="table mb-0">
        
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Cédula</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($participantes as $key => $participante)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $participante->nombre }}</td>
                                            <td>{{ $participante->apellido }}</td>
                                            <td>{{ $participante->cedula }}</td>
                                            <td>{{ $participante->correo }}</td>
                                            <td>+{{ $participante->pais.$participante->telefono }}</td>
                                            <td>
                                                <a href="{{ route('participante.show',$participante->id) }}"><i class="ri-eye-line"></i></a>
                                                <a href="{{ route('participante.edit',$participante->id) }}"><i class="ri-edit-line"></i></a>
                                                <a href="javascript:void(0);" data-href="{{ route('participante.destroy',$participante->id) }}" class="delete-confirm"><i class="ri-delete-bin-line"></i></a>
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
