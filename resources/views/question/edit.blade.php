@extends('layouts.default')

@section('title') Cập nhật câu hỏi @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Cập nhật câu hỏi</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('questions.index') }}" title="Quản lý câu hỏi" data-toggle="tooltip" data-placement="top">Quản lý câu hỏi</a></li>
                                    <li class="breadcrumb-item active">Cập nhật câu hỏi</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">

                                <form method="POST" action="{{ route('questions.update', $data_edit->id) }}" enctype="multipart/form-data" class="repeater custom-validation">
                                    @method('PUT')
                                    @include('question._form')
                                    
                                </form>

                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection

@push('js')
    <!-- form repeater js -->
    <script src="{{ asset('libs\jquery.repeater\jquery.repeater.min.js') }}"></script>

    <script src="{{ asset('js\pages\form-repeater.int.js') }}"></script>

    <script src="{{ asset('libs\parsleyjs\parsley.min.js') }}"></script>

    <script src="{{ asset('js\pages\form-validation.init.js') }}"></script>
@endpush

@push('css')
@endpush