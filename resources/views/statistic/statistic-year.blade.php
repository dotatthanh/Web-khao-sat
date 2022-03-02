@extends('layouts.default')

@section('title') Thống kê trong năm @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thống kê trong năm</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Thống kê" data-toggle="tooltip" data-placement="top">Thống kê</a></li>
                                    <li class="breadcrumb-item active">Thống kê trong năm</li>
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

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Mã lớp</th>
                                                <th>Số lượt khảo sát</th>
                                                <th>Số người đang có việc làm</th>
                                                <th>Số người chưa có việc làm</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($classes as $class)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $class->ma_lop }}</td>
                                                    <td>{{ $class->total }}</td>
                                                    <td>{{ number_format($class->dang_lam_viec / $class->total * 100, 1) }}%</td>
                                                    <td>{{ number_format($class->chua_co_viec / $class->total * 100, 1) }}%</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $classes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
@endsection