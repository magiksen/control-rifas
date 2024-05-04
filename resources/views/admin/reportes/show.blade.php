@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Reportes Tickets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reportes</a></li>
                                <li class="breadcrumb-item active">Tickets</li>
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

                            <h4 class="card-title">Reportes de tickets {{ $slug }}</h4>
                            <p class="card-title-desc">Visualizar reportes de los tickets {{ $slug }}</p>
                            @if($slug == "libres")
                                <div class="row">
                                    @foreach($data as $numero)
                                        <div class="col-xl-1 text-center m-2">
                                            <a href="{{ route('tickets.create',$numero->numero) }}" type="button" class="btn btn-success waves-effect waves-light">{{ $numero->numero }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                            <div class="table-responsive">
                                <table id="datatable" class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>Numero</th>
                                        <th>Participante</th>
                                        <th>Vendedor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $ticket)
                                        <tr>
                                            <td>{{ $ticket->numero->numero }}</td>
                                            <td>{{ $ticket->participante->nombre }} {{ $ticket->participante->apellido }}</td>
                                            <td>{{ $ticket->user->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div><!-- end row -->

        </div>
        <!-- end row -->
    </div>

    </div>

@endsection
