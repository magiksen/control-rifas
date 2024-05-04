@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Reportes Tickets</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reportes</a></li>
                                <li class="breadcrumb-item active">Tickets</li>
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

                            <h4 class="card-title">Reportes Tickets</h4>
                            <p class="card-title-desc">Visualizar reportes de los tickets</p>

{{--                            <div class="row mb-3">--}}
{{--                               <p>Tickets Comprados:</p>--}}
{{--                               <p class="alert-info col-12 col-sm-2 col-md-1 col-lg-1  p-2 rounded text-center"><strong>{{ $tomados }}</strong></p>--}}
{{--                            </div>--}}
                            <div class="row mb-3">
                               <p>Tickets Apartados:</p>
                               <p class="alert-warning col-12 col-sm-2 col-md-1 col-lg-1  p-2 rounded text-center"><strong><a
                                           href="{{ route('reporte.show', 'apartados') }}">{{ $apartados }}</a></strong></p>
                            </div>
                            <div class="row mb-3">
                               <p>Tickets Pagados:</p>
                               <p class="alert-danger col-12 col-sm-2 col-md-1 col-lg-1  p-2 rounded text-center"><strong><a
                                           href="{{ route('reporte.show', 'pagados') }}">{{ $pagados }}</a></strong></p>
                            </div>
                            <div class="row mb-3">
                               <p>Tickets Libres:</p>
                               <p class="alert-success col-12 col-sm-2 col-md-1 col-lg-1  p-2 rounded text-center"><strong><a
                                           href="{{ route('reporte.show', 'libres') }}">{{ $libres }}</a></strong></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- end row -->

        </div>
        <!-- end row -->
    </div>

    </div>

@endsection
