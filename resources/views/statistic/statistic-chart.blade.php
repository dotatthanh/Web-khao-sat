@extends('layouts.default')

@section('title') Thống kê biểu đồ @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thống kê biểu đồ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Thống kê" data-toggle="tooltip" data-placement="top">Thống kê</a></li>
                                    <li class="breadcrumb-item active">Biểu đồ</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="container" style="width: 100%; height: 400px"></div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
@endsection

@push('js')
    <script src="{{ asset('js\anychart-core.min.js') }}"></script>

    <script src="{{ asset('js\anychart-pie.min.js') }}"></script>

    <script>
        let data = JSON.parse(`<?= $result ?>`);

        anychart.onDocumentReady(function() {

            // var data = [
            //     {x: "Có việc làm", value: 1},
            //     {x: "Chưa có việc làm", value: 38929319},
            //     {x: "Chưa có nhu cầu", value: 38929319},
            //     {x: "Đang vừa học vừa làm", value: 38929319},
            //     {x: "Đang đi học", value: 38929319},
            // ];

            var chart = anychart.pie();

            chart.title("Biểu đồ");

            chart.data(data);

            chart.container('container');
            chart.draw();

        });
    </script>
@endpush