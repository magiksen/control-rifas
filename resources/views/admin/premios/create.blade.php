@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Crear Premio</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Premio</a></li>
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
                            <form method="post" action="{{ route('store.premio') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nombre" class="col-sm-2 col-form-label">Premio</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" placeholder="Premio" id="nombre" name="nombre" :value="old('nombre')" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="loteria" class="col-sm-2 col-form-label">Lotería</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" placeholder="Lotería" id="loteria" name="loteria" :value="old('loteria')">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="hora" class="col-sm-2 col-form-label">Hora</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="time" value="12:00:00" id="hora" name="hora">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="numero" class="col-sm-2 col-form-label">Numero Ganador</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" placeholder="Numero" id="numero" name="numero" :value="old('numero')">
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
