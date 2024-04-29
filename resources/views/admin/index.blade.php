@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Escritorio</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ManSon</a></li>
                            <li class="breadcrumb-item active">Escritorio</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="card col-sm-12 col-md-12 col-lg-5 mb-2">
                <div class="card-body">

                    <h4 class="card-title">Tickets</h4>
                    <div id="chart" class="chart"></div>
                </div>
            </div>
            <div class="card col-sm-12 col-md-12 col-lg-5 mb-2" style="margin-left: 10px;">
                <div class="card-body">

                    <h4 class="card-title">Top 10 Vendedores</h4>
                    <div id="vendedores-chart" class="chart"></div>
                </div>
            </div>
            <div class="card col-sm-12 col-md-12 col-lg-5 mb-2">
                <div class="card-body">

                    <h4 class="card-title">Top 10 Participantes</h4>
                    <div id="participantes-chart" class="chart"></div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- apexcharts -->
<script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script>
    var options = {
        series: [{{ $tomados }}, {{ $pagados }}, {{ $apartados }}, {{ $libres }}],
        chart: {
            width: 500,
            type: 'pie',
        },
        labels: ['Comprados', 'Pagados', 'Apartados', 'Libres'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
<script>
    var options = {
        series: [{
            data: []
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                borderRadiusApplication: 'end',
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: [],
        }
    };

    const vendedoresData = @json($vendedores);
    const vendedores = JSON.parse(vendedoresData);
    vendedores.forEach(function(elemento) {
        options.series[0].data.push(elemento.count);
        options.xaxis.categories.push(elemento.nombre);
    })

    var chart = new ApexCharts(document.querySelector("#vendedores-chart"), options);
    chart.render();
</script>
<script>
    var options = {
        series: [{
            data: []
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                borderRadiusApplication: 'end',
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: [],
        }
    };

    const participantesData = @json($participantes);
    const participantes = JSON.parse(participantesData);
    participantes.forEach(function(elemento) {
        options.series[0].data.push(elemento.count);
        options.xaxis.categories.push(elemento.nombre+' '+elemento.apellido);
    })

    var chart = new ApexCharts(document.querySelector("#participantes-chart"), options);
    chart.render();
</script>

@endsection
