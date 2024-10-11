@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Crear Varios Tickets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                                <li class="breadcrumb-item active">Crear Varios</li>
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

                            <h4 class="card-title">Datos de los Tickets</h4>
                            <p class="card-title-desc">Ingresa los datos de los tickets</p>
                            <form method="post" action="{{ route('tickets.multiplestore') }}">
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
                                        <option value="{{ $vendedor->id }}">{{ $vendedor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="numeros" class="col-sm-2 col-form-label">Numero</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="numeros[]" id="numeros" multiple="multiple">
                                            @foreach($numeros as $numero)
                                            @if($numero->participante_id == 0)
                                            <option value="{{ $numero->id }}">{{ $numero->numero }}</option>
                                            @endif
                                            @endforeach    
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            @hasanyrole('Admin|SuperAdmin')
                            <div class="row m-3 col-4">
                                <div class="form-check form-switch" dir="ltr">
                                    <label class="form-check-label" for="pago">Tickets pagados</label>
                                    <input type="checkbox" class="form-check-input" id="pago" name="pago" value="1">
                                </div>
                            </div>
                            @endhasanyrole
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
