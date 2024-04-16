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
                               <p>Nombre: {{ $vendedor->name }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Correo: {{ $vendedor->email }}</p>
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
            @use('App\Models\Participante')
            @if($ticketsVendidos !== 0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Tickets del vendedor</h4>
                            <p class="card-title-desc">Tickets vendidos por el vendedor</p>
                            
                            <div class="row">
                            @foreach($ticketsVendidos as $participanteId => $tickets)
                            <div class="row mb-3 col-12">
                                    <h4><strong>Participante: {{ Participante::find($participanteId)->nombre }} {{ Participante::find($participanteId)->apellido }}</strong></h4>
                                    <div class="row">
                                         @foreach ($tickets as $ticket)
                                        <div class="col-3">
                                            <p><strong>Ticket #{{ $ticket->numero->numero }}</strong></p>
                                            <a href="{{ route('ticket.show',$ticket->id) }}"><img class="img-thumbnail img-fluid" src="{{ asset($ticket->imagen) }}" alt="{{ $ticket->numero->numero }}"></a>
                                        </div>
                                        @endforeach    
                                    </div>
                            </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger col-12" role="alert">
                Sin Tickets Vendidos
            </div>
            @endif


            <!-- end row -->
        </div>
        <!-- end row -->
    </div>

    </div>

@endsection
