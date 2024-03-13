@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ver Ticket</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ticket</a></li>
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

                            <h4 class="card-title">Datos del Ticket</h4>
                            <p class="card-title-desc">Visualizar los datos del ticket</p>

                            <div class="row mb-3">
                               <p>Numero: {{ $ticket->numero->numero }}</p>
                            </div>
                            <div class="row mb-3">
                               <p>Nombre: {{ $ticket->participante->nombre }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Apellido: {{ $ticket->participante->apellido }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Cedula: {{ $ticket->participante->cedula }}</p>
                            </div>
                            <div class="row mb-3">
                                <p>Telefono: {{ $ticket->participante->telefono }}</p>
                            </div>
                            <div class="row mb-3">
                                <div style="width:500px;">
                                    <img class="img-thumbnail img-fluid" src="{{ asset($ticket->imagen) }}" alt="{{ $ticket->numero->numero }}">
                                </div>
                            </div>
                            <!-- end row -->
                            @if($ticket->pago == 1)
                            <div class="alert alert-success col-4" role="alert">
                                El Ticket esta pago
                             </div>
                            <a href="{{ route('message.send',$ticket->id) }}" class="btn btn-primary">Enviar ticket</a>
                            @else
                            <div class="alert alert-danger col-4" role="alert">
                                El Ticket no ha sido pagado
                             </div>
                            <a href="javascript:void(0);" data-href="{{ route('ticket.pagar', $ticket->id) }}" class="btn btn-success pagar-confirm">Pagar</a>
                            <a href="javascript:void(0);" data-href="{{ route('ticket.destroy', $ticket->id) }}" class="btn btn-danger delete-confirm">Eliminar ticket</a>
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
