@extends('layouts.default')

@section('title') Trang chủ @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Trang chủ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                                    <li class="breadcrumb-item active">Trang chủ</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-3">
                                            <h5 class="text-primary">Chào mừng trở lại!</h5>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('images\profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <div class="avatar-md">
                                                <span class="avatar-title rounded-circle text-uppercase">
                                                    {{ substr(auth()->user()->ten, 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <h5 class="font-size-15 text-truncate">{{ auth()->user()->ten }}</h5>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="pt-4">
                                         
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="font-size-15">Tài khoản</h5>
                                                    <p class="text-muted mb-0">{{ auth()->user()->admin == 1 ? 'Admin' : 'TK khảo sát' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->



                        
                    </div>  
                    <div class="col-xl-8">
                        <div class="row">
                            @if (auth()->user()->admin)
                                <div class="col-md-6">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-muted font-weight-medium">Tổng số lượt khảo sát trong ngày</p>
                                                    <h4>{{ $total_survey_of_day }} lượt</h4>
                                                </div>

                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                    <span class="avatar-title">
                                                        <i class="bx bx-copy-alt font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mini-stats-wid">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p class="text-muted font-weight-medium">Tổng số lượt khảo sát trong tháng</p>
                                                    <h4>{{ $total_survey_of_month }} lượt</h4>
                                                </div>

                                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                        <i class="bx bx-archive-in font-size-24"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col">
                                    <h3 class="text-danger font-weight-bold text-uppercase text-center mt-5">Chào mừng bạn đến với Hệ thống khảo sát trực tuyến về thông tin việc làm của cựu sinh viên Trường Đại học Trà Vinh</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
                <!-- end row -->
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
@endsection