@extends('layouts.default')

@section('title') Cập nhật lớp học @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Cập nhật lớp học</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('classes.index') }}" title="Quản lý lớp học" data-toggle="tooltip" data-placement="top">Quản lý lớp học</a></li>
                                    <li class="breadcrumb-item active">Cập nhật lớp học</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">

                                <form method="POST" action="{{ route('classes.update', $data_edit->id) }}" enctype="multipart/form-data">
                                    @method('PUT')
                                    @include('class._form')
                                    
                                </form>

                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        
    </div>
@endsection