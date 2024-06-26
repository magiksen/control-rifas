@extends('admin.admin_master')
@section('admin')

<div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Perfil</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">usuario</a></li>
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

                            <h4 class="card-title">Tus Datos</h4>
                            <p class="card-title-desc">Visualiza o Edita tus datos</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nombre y Apellido</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Nombre y Apellido" id="name" name="name" value="{{ $profileData->name}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 col-form-label">Correo</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="email" name="email" value="{{ $profileData->email }}"  type="email" required placeholder="Email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cedula" class="col-sm-2 col-form-label">Cedula</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Cédula" id="cedula" name="cedula" value="{{ $profileData->cedula }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="pais" class="col-sm-2 col-form-label">Pais</label>
                                <div class="col-sm-10">
                                    <select class="form-select buscable" name="pais" id="pais">
                                        @if($pais_selected != NULL)
                                        <option value="{{ $pais_selected->pais_numero }}">{{ $pais_selected->pais_nombre.' +'.$pais_selected->pais_numero }}</option>
                                        @endif
                                        @foreach($paises as $pais)
                                        <option value="{{ $pais->pais_numero }}">{{ $pais->pais_nombre.' +'.$pais->pais_numero }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="tel" placeholder="04241234567" id="telefono" name="telefono" value="{{ $profileData->telefono }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar Contraseña</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Repetir contraseña">
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
