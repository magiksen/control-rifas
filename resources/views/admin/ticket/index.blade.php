@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ver Tickets</h4>

                        @if(auth()->user()->hasanyrole('Admin|SuperAdmin'))
                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ route('tickets.control') }}" class="btn btn-info">Crear imagen de Control</a>
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

                            <h4 class="card-title">Lista de tickets</h4>
                            <p class="card-title-desc">Visualizar la lista de tickets registrados</p>

                            @if(auth()->user()->hasanyrole('Admin|SuperAdmin'))
                                <div class="row">
                                    @foreach($numeros as $numero)
                                        <div class="col-xl-1 text-center m-2">
                                            @if($numero->ticket_id == 0)
                                                <a href="{{ route('tickets.create',$numero->numero) }}" type="button" class="btn btn-success waves-effect waves-light">{{ $numero->numero }}</a>
                                            @elseif($numero->ticket_id !== 0 && $numero->ticket->pago == 0)
                                                <a href="{{ route('ticket.show',$numero->ticket_id) }}" type="button" class="btn btn-warning waves-effect waves-light">{{ $numero->numero }}</a>
                                            @else
                                                <a href="{{ route('ticket.show',$numero->ticket_id) }}" type="button" class="btn btn-danger waves-effect waves-light">{{ $numero->numero }}</a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row">
                                    @foreach($numeros as $numero)
                                        <div class="col-xl-1 text-center m-2">
                                            @if($numero->ticket_id == 0)
                                                <a href="#" type="button" class="btn btn-success waves-effect waves-light">{{ $numero->numero }}</a>
                                            @elseif($numero->ticket_id !== 0 && $numero->ticket->pago == 0)
                                                <a href="#" type="button" class="btn btn-secondary waves-effect waves-light disabled">{{ $numero->numero }}</a>
                                            @else
                                                <a href="{{ route('ticket.show',$numero->ticket_id) }}" type="button" class="btn btn-secondary waves-effect waves-light disabled">{{ $numero->numero }}</a>
                                            @endif
                                        </div>
                                    @endforeach
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
