@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Editar Opción</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Opción</a></li>
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

                            <h4 class="card-title">Opción</h4>
                            <p class="card-title-desc">Ingresa el valor de la opción</p>
                            <form method="POST" action="{{ route('opcion.update', $opcion->id) }}">
                                @csrf
                            <div class="row mb-3">
                                <label for="opcion" class="col-sm-2 col-form-label">Opción</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Opción" id="opcion" value="{{ $opcion->opcion }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="valor" class="col-sm-2 col-form-label">Valor</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Valor" id="valor" name="valor" value="{{ $opcion->valor }}">
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
