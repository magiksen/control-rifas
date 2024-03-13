@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Editar Participante</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Participante</a></li>
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

                            <h4 class="card-title">Datos del participante</h4>
                            <p class="card-title-desc">Ingresa los datos del participante</p>
                            <form method="POST" action="{{ route('participante.update', $participante->id) }}">
                                @csrf
                            <div class="row mb-3">
                                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id" value="{{ $participante->id }}">
                                    <input class="form-control" type="text" placeholder="Nombre" id="nombre" name="nombre" value="{{ $participante->nombre }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Apellido" id="apellido" name="apellido" value="{{ $participante->apellido }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cedula" class="col-sm-2 col-form-label">Cedula</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Cédula" id="cedula" name="cedula" value="{{ $participante->cedula }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" placeholder="correo@correo.com" id="correo" name="correo" value="{{ $participante->correo }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pais" class="col-sm-2 col-form-label">Pais</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="pais" id="pais">
                                        <option value="{{ $pais_selected->pais_numero }}">{{ $pais_selected->pais_nombre.' +'.$pais_selected->pais_numero }}</option>
                                        @foreach($paises as $pais)
                                        <option value="{{ $pais->pais_numero }}">{{ $pais->pais_nombre.' +'.$pais->pais_numero }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="tel" placeholder="04241234567" id="telefono" name="telefono" value="{{ $participante->telefono }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <button class="btn btn-primary" type="submit">Actualizar</button>
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
