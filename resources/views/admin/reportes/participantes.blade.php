@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Reportes Paticipantes</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reportes</a></li>
                                <li class="breadcrumb-item active">Participantes</li>
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

                            <h4 class="card-title">Reportes Participantes</h4>
                            <p class="card-title-desc">Visualizar reportes de los participantes</p>

                            <div class="table-responsive">
                                <table class="table mb-0">
        
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Numero de Tickets</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($participantes as $participante)
                                        <tr>
                                            <td>{{ $participante->nombre }}</td>
                                            <td>{{ $participante->apellido }}</td>
                                            <td><strong>{{ $participante->count }}</strong></td>
                                        </tr>
                                        @endforeach      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- end row -->

        </div>
        <!-- end row -->
    </div>

    </div>

@endsection
