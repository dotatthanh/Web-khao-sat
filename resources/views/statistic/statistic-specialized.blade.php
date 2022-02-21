@extends('layouts.default')

@section('title') Thống kê trong ngày @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thống kê trong ngày</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Thống kê" data-toggle="tooltip" data-placement="top">Thống kê</a></li>
                                    <li class="breadcrumb-item active">Trong ngày</li>
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
                                <form method="GET" action="{{ route('statistic.specialized') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <select class="form-control select2" name="search">
                                                <option value="">Chọn nội dung phương án trả lời</option>
                                                @foreach ($answers as $answer)
                                                    <option value="{{ $answer->id }}">{{ $answer->noi_dung }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>
                                        
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Mã ngành</th>
                                                <th>Số câu trả lời</th>
                                                <th>Nội dung phương án trả lời</th>
                                                <th>Nội dung câu hỏi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($specializeds as $class)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $class->specialized->ma_nganh }}</td>
                                                    <td>{{ $class->count_answer }}</td>
                                                    <td>{{ $class->answer->noi_dung }}</td>
                                                    <td>{{ $class->question->noi_dung }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $specializeds->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
@endsection