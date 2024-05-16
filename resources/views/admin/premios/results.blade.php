@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Resultados y Ganadores</h4>

                        @if(auth()->user()->hasanyrole('Admin|SuperAdmin'))
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <a href="{{ route('premios.index') }}" class="btn btn-info">Agregar numeros ganadores</a>
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

                            <h4 class="card-title">Tickets Ganadores</h4>
                            <p class="card-title-desc">Visualizar los tickets ganadores</p>

                            @use('App\Models\Numero')
                            @if($premios->count() > 0)
                                @foreach($premios as $key => $premio)
                                    @if(!empty($premio->numero))
                                        @if(Numero::where('numero', $premio->numero)->first()->ticket_id > 0)
                                            <div class="row">
                                                <div class="col-6">
                                                    <hr>
                                                    <h4 class="alert alert-success"><strong>Ganador para el premio {{$premio->nombre}} con el Ticket numero: {{$premio->numero}}</strong></h4>
                                                    <a href="#"><img class="img-thumbnail img-fluid" src="{{ Numero::where('numero', $premio->numero)->first()->ticket->imagen }}"></a>
                                                    <hr>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="alert alert-danger"><strong>No hay ganador para el Premio {{$premio->nombre}} con el numero {{$premio->numero}} </strong></h4>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-6">
                                       <h4>No se han registrado los premios del sorteo</h4>
                                    </div>
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
