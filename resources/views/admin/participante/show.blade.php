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
                                <p>Telefono: +{{ $participante->pais.$participante->telefono }}</p>
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

                            <h4 class="card-title">Tickets del participante</h4>
                            <p class="card-title-desc">Tickets obtenidos por el participante</p>

                            <div class="row">
                            @if(count($participante->tickets) != 0)
                                @foreach($participante->tickets as $ticket)
                                <div class="row mb-3 col-3">
                                    <div style="width:200px;">
                                        <p><strong>Ticket #{{ $ticket->numero->numero }}</strong></p>
                                        @if($ticket->pago == 1)
                                        <div class="alert alert-success col-12" role="alert">
                                            Ticket esta pago
                                        </div>
                                        @else
                                        <div class="alert alert-danger col-12" role="alert">
                                            Ticket no ha sido pagado
                                        </div>
                                        @endif
                                        <a href="{{ route('ticket.show',$ticket->id) }}"><img class="img-thumbnail img-fluid" src="{{ asset($ticket->imagen) }}" alt="{{ $ticket->numero->numero }}"></a>
                                    </div>
                                </div>
                                @endforeach
                                </div>
                                @if($allTicketsPaid)
                                <div class="alert alert-success col-6" role="alert">
                                    Los tickets han sido pagados y enviados al participante.
                                </div>
                                <a href="{{ route('message.multiple',$participante->id) }}" class="btn btn-success">Volver a enviar tickets</a>
                                @else
                                <a href="javascript:void(0);" data-href="{{ route('message.multiple',$participante->id) }}" class="btn btn-success pagar-enviar">Pagar y enviar tickets</a>
                                @endif
                            @else
                            <div class="alert alert-danger col-5" role="alert">
                                El participante no ha comprado ningun ticket
                            </div>
                            @endif
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
