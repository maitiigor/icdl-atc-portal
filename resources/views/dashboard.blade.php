@extends('layouts.app')
@section('title')
    @lang('translation.Dashboards')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Welcome !
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Modules</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $total_modules }}">0</span>
                            </h4>
                            {{-- <div class="text-nowrap">
                            <span class="badge bg-soft-success text-success">+$20.9k</span>
                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                        </div> --}}
                        </div>

                        <div class="flex-shrink-0 text-end dash-widget">
                            <div id="mini-chart1" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Sub Modules</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $total_sub_modules }}"></span>
                            </h4>
                            {{-- <div class="text-nowrap">
                            <span class="badge bg-soft-danger text-danger">-29 Trades</span>
                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                        </div> --}}
                        </div>
                        <div class="flex-shrink-0 text-end dash-widget">
                            <div id="mini-chart2" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Applications</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $total_applications }}"></span>
                            </h4>
                            {{-- <div class="text-nowrap">
                            <span class="badge bg-soft-success text-success">+ $2.8k</span>
                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                        </div> --}}
                        </div>
                        <div class="flex-shrink-0 text-end dash-widget">
                            <div id="mini-chart3" data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div><!-- end row-->

    <!-- end row-->
@endsection
@push('page_scripts')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // var options = {
            //     series: [ [], []],
            //     labels: ['Total CBM', 'Available CBM'],
            //     chart: {
            //         type: 'pie',
            //         height: 400
            //     },
            //     colors: ["#1c84ee", "#33c38e"],
            //     legend: {
            //         postition: 'bootom',
            //     },
            //     dataLabels: {
            //         enabled: true,
            //     },
            //     title: {
            //         text: 'CBM / Available CBM',
            //         align: 'center'
            //     },
            // };
            // var chart = new ApexCharts(document.querySelector("#cbm-overview"), options);
            // chart.render(); // mini-2 
        })
    </script>
@endpush
