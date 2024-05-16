@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ver Premios</h4>

                        @if(auth()->user()->hasanyrole('Admin|SuperAdmin'))
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <a href="{{ route('crear.premio') }}" class="btn btn-success">Crear premio</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Lista de premios</h4>
                            <p class="card-title-desc">Visualizar la lista de premios registrados</p>

                            <div class="table-responsive">
                                <table id="datatable" class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Premio</th>
                                        <th>Loteria</th>
                                        <th>Hora</th>
                                        <th>Numero Ganador</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($premios as $key => $premio)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $premio->nombre }}</td>
                                            <td>{{ $premio->loteria }}</td>
                                            <td>{{ $premio->hora }}</td>
                                            <td>{{ $premio->numero }}</td>
                                            <td>
                                                <a href="{{ route('premio.edit',$premio->id) }}"><i class="ri-edit-line"></i></a>
                                                <a href="javascript:void(0);" data-href="{{ route('premio.destroy',$premio->id) }}" class="delete-confirm"><i class="ri-delete-bin-line"></i></a>
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
