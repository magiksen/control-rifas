@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Editar Premio</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Premio</a></li>
                                <li class="breadcrumb-item active">Editar</li>
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

                            <h4 class="card-title">Detalles del premio</h4>
                            <p class="card-title-desc">Ingresa los detalles del premio</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('premio.update', $premio->id) }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nombre" class="col-sm-2 col-form-label">Premio</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" value="{{ $premio->nombre }}" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="loteria" class="col-sm-2 col-form-label">Lotería</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" value="{{ $premio->loteria }}" id="loteria" name="loteria">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="hora" class="col-sm-2 col-form-label">Hora</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="time" value="{{ $premio->hora }}" id="hora" name="hora">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="numero" class="col-sm-2 col-form-label">Numero Ganador</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" value="{{ $premio->numero }}" id="numero" name="numero">
                                    </div>
                                </div>
                                <!-- end row -->

                                <button class="btn btn-primary" type="submit">Editar</button>
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
