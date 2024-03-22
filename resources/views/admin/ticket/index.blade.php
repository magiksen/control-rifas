@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ver Tickets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
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
                            <div style="padding:15px;">
                                <a href="{{ route('tickets.control') }}" style="display:block;float:right;" type="button" class="btn btn-info">Crear imagen de control</a>
                            </div>
                        <div class="card-body">

                            <h4 class="card-title">Lista de tickets</h4>
                            <p class="card-title-desc">Visualizar la lista de tickets registrados</p>
                            
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