@extends('layouts.app')
@section('content')
<!-- Main Sidebar Container -->
@include('components.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 1345.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Asset Type</h3>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="donutChart" height="200vh" class="chartjs-render-monitor"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Asset</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="barChart" height="200vh" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    @php
    $counts = [];
    $pie_names = [];
    foreach($asset_types as $asset_type) {
    array_push($counts, count($asset_type->asset));
    array_push($pie_names, $asset_type->type_name);
    }
    $active = [];
    $inactive = [];
    $bar_names = [];
    foreach($assets as $asset) {
    array_push($active, $asset->active);
    array_push($inactive, $asset->inactive);
    array_push($bar_names, $asset->asset_type->type_name);
    }
    @endphp
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
    // Pie-chart 
    const pie = document.getElementById('donutChart').getContext('2d');
    let doughnut_data = JSON.parse('{!! json_encode($counts) !!}');
    let labels = JSON.parse('{!! json_encode($pie_names) !!}');
    const pieChart = new Chart(pie, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: doughnut_data,
                backgroundColor: [
                    'rgba(0, 123, 255, 1)',
                    'rgba(220, 53, 69, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(23, 162, 184, 1)',
                    'rgba(102, 16, 242, 1)',
                    'rgba(240, 18, 190, 1)',
                    'rgba(255, 133, 27, 1)',
                    'rgba(1, 255, 112, 1)',
                    'rgba(60, 141, 188, 1)',
                    'rgba(96, 92, 168, 1)',
                    'rgba(232, 62, 140, 1)',
                    'rgba(57, 204, 204, 1)',
                    'rgba(216, 27, 96, 1)',
                    'rgba(61, 153, 112, 1)',
                    'rgba(0, 31, 63, 1)',
                    'rgba(108, 117, 125, 1)',
                ],
            }]
        },
    });
    // Bar chart 
    const bar = document.getElementById('barChart').getContext('2d');
    let active = JSON.parse('{!! json_encode($active) !!}');
    let inactive = JSON.parse('{!! json_encode($inactive) !!}');
    labels = JSON.parse('{!! json_encode($bar_names) !!}');
    const barChart = new Chart(bar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Active',
                data: active,
                backgroundColor: 'rgba(0, 123, 255, 1)',
            }, {
                label: 'Inactive',
                data: inactive,
                backgroundColor: 'rgba(220, 53, 69, 1)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
        }
    });
</script>
@endsection