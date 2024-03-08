@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Crear Ticket</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                                <li class="breadcrumb-item active">Crear</li>
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
                            <p class="card-title-desc">Ingresa los datos del ticket</p>
                            <form method="post" action="{{ route('tickets.store') }}">
                                @csrf
                            <div class="row mb-3">
                                <label for="participante" class="col-sm-2 col-form-label">Participante</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="participante" id="participante">
                                        @foreach($participantes as $participante)
                                        <option value="{{ $participante->id }}">{{ $participante->nombre.' '.$participante->apellido }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="vendedor" class="col-sm-2 col-form-label">Vendedor</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="vendedor" id="vendedor">
                                        @foreach($vendedores as $vendedor)
                                        <option value="{{ $vendedor->id }}">{{ $vendedor->nombre.' '.$vendedor->apellido }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="numero" class="col-sm-2 col-form-label">Numero</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="numero" id="numero">
                                        @if($numero_solo == null)
                                            @foreach($numeros as $numero)
                                            @if($numero->participante_id == 0)
                                            <option value="{{ $numero->id }}">{{ $numero->numero }}</option>
                                            @endif
                                            @endforeach
                                        @else
                                        <option value="{{ $numero_solo->id }}">{{ $numero_solo->numero }}</option>
                                        @endif    
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <button class="btn btn-primary" type="submit">Crear</button>
                            </form>
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
