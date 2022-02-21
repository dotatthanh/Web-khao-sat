@extends('layouts.default')

@section('title') Khảo sát @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Khảo sát</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Khảo sát</li>
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
                                <h1 class="font-weight-bold text-center text-success">NỘI DUNG KHẢO SÁT</h2>
                                <p class="text-center text-success">Tình hình việc làm của sinh viên Trường Đại học Trà Vinh sau khi tốt nghiệp</p>
                                <p>Anh/Chị vui lòng dành ít thời gian tham gia phiếu khảo sát này. Thông tin trả lời của Anh/Chị chỉ được sử dụng cho mục đích cải tiến hoạt động Dạy - Học và nâng cao cơ hội việc làm cho sinh viên sau tốt nghiệp.</p>

                                <p class="text-danger">Ngày trả lời khảo sát: {{ date('d-m-Y') }}</p>

                                <form action="{{ route('surveys.store') }}" class="position-relative" method="POST">
                                    @csrf
                                    <h2 class="text-success font-weight-bold">A. THÔNG TIN CÁ NHÂN</h2>

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Họ và tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Họ và tên">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="code_student" class="col-sm-2 col-form-label">Mã sinh viên</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="code_student" id="code_student" placeholder="Mã sinh viên">
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label for="gender" class="col-sm-2 col-form-label">Giới tính</label>
                                <div class="col-sm-10">
                                  <select name="gender" id="gender" class="form-control">
                                        <option value="">Chọn giới tính</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <label for="code_class" class="col-sm-2 col-form-label">Mã lớp <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="code_class" id="code_class" class="form-control">
                                    <option value="">Chọn mã lớp</option>
                                    @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->ma_lop }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('code_class', '<span class="error">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Điện thoại">
                              {!! $errors->first('phone', '<span class="error">:message</span>') !!}
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                      </div>
                  </div>

                  <h2 class="text-success font-weight-bold">B. THÔNG TIN VỀ TÌNH HÌNH VIỆC LÀM</h2>

                  @php
                  $stt = -1;
                  @endphp
                  <div class="questions pl-3 position-relative">
                    @foreach ($questions as $question)
                    @php
                    $stt++;
                    @endphp
                    <div class="question survey_step" id="answers{{ $stt }}" data-step="{{ $stt+1 }}">
                        <h4 class="text-danger">{{ $question->ten }}: {{ $question->noi_dung }}</h4>
                        @foreach ($question->answers as $answer)
                        <div class="pl-3">
                            @if ($question->cach_chon_dap_an == 1)
                            <input class="form-check-input" type="checkbox" name="answers[{{ $stt }}][{{ $question->id }}][{{ $answer->id }}]" value="{{ $answer->id }}" id="answer{{ $answer->id }}" data-val="{{ $answer->noi_dung }}">

                            <input class="form-check-input" type="checkbox" name="check_answers[{{ $stt }}][{{ $question->id }}]" id="checked_answer{{ $answer->id }}" hidden data-val="{{ $answer->noi_dung }}">
                            @else
                            <input class="form-check-input" type="radio" name="answers[{{ $stt }}][{{ $question->id }}]" value="{{ $answer->id }}" id="answer{{ $answer->id }}" data-val="{{ $answer->noi_dung }}">
                            @endif
                            <label for="answer{{ $answer->id }}">{{ $answer->ten }}: {{ $answer->noi_dung }}</label>
                        </div>

                        @endforeach
                    </div>
                    @endforeach

                    <div class="text-center">
                        <button id="back_button" type="button" class="btn btn-primary mb-2 disabled">Quay lại</button>
                        <button id="next_button" type="button" class="btn btn-primary mb-2 disabled">Tiếp tục</button>
                        <button id="submit_button" type="submit" class="btn btn-primary mb-2 disabled">Hoàn tất</button>
                        <a class="btn btn-primary mb-2" href="{{ route('dashboard') }}">Thoát</a>
                    </div>
                </div>
            </form>
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

    <script type="text/javascript">

        let total_question = JSON.parse(`<?= $questions->count() ?>`);
        function next(step, next_step) {
            if (next_step == 3 && step == 1) {
                $('body').attr('data-prev', 1);
            } else {
                $('body').attr('data-prev', step);
            }

            var value = $('.survey_step[data-step="'+next_step+'"]').find('.form-check-input:checked').data('val')


            if (value) {
                $('#next_button').removeClass('disabled');
            } else {
                $('#next_button').addClass('disabled');
            }

            $('#back_button').removeClass('disabled');
        }

        function back(step, prev_step) {

            $('body').attr('data-step', prev_step);

            if (prev_step == 3) {

                var value = $('.survey_step[data-step="1"]').find('.form-check-input:checked').data('val');
                // Kiểm tra câu 2
                if (value == 'Đang có việc làm' || value == 'Đang vừa học vừa làm') {
                    $('body').attr('data-prev', 1);
                }

                if (value == 'Chưa có việc làm') {
                    $('body').attr('data-prev', 2);
                }
            } else {
                $('body').attr('data-prev', parseFloat(prev_step) - 1);
            }

            var value = $('.survey_step[data-step="'+prev_step+'"]').find('.form-check-input:checked').data('val')

            if (value) {
                $('#next_button').removeClass('disabled');
            } else {
                $('#next_button').addClass('disabled');
            }

            $('#submit_button').addClass('disabled');
            $('body').attr('data-next', parseFloat(prev_step) + 1);
        }

        function condition(step, next_step) {
            if (step == 1) {
                $('#back_button').addClass('disabled');

                var value = $('.survey_step[data-step="1"]').find('.form-check-input:checked').data('val');
                // Kiểm tra câu 2
                if (value == 'Đang có việc làm' || value == 'Đang vừa học vừa làm') {
                    $('body').attr('data-next', 3);
                }

                if (value == 'Chưa có việc làm') {
                    $('body').attr('data-next', 2);
                }

                if (value == 'Đang học tiếp' || value == 'Chưa có nhu cầu') {
                    $('#submit_button').removeClass('disabled');
                    $('#next_button').addClass('disabled');
                } else {
                    $('#submit_button').addClass('disabled');
                }

            } 
            if (step == 2) {
                $('#submit_button').removeClass('disabled');
                $('#next_button').addClass('disabled');
            }
            if (step == 8) {
                var value = $('.survey_step[data-step="8"]').find('.form-check-input:checked').data('val');
                // Kiểm tra câu 8
                if (value == 'Đúng ngành đào tạo' || value == 'Có liên quan đến ngành đào tạo') {
                    $('body').attr('data-next', 10);

                }
                else {
                    $('body').attr('data-next', 9);
                }
            } else if (step == total_question || step == 9) {
                $('#submit_button').removeClass('disabled');
                $('#next_button').addClass('disabled');
            }
        }

        jQuery(document).ready(function() {

            $('.form-check-input').change(function() {

                var step = $('body').attr('data-step');
                var next_step = $('body').attr('data-next');

                condition(step, next_step);

                var value = $('.survey_step[data-step="'+step+'"]').find('.form-check-input:checked').data('val')
                
                if (value) {
                    if (value == 'Đang học tiếp' || value == 'Chưa có nhu cầu') {
                        $('#next_button').addClass('disabled');
                    } else {
                        $('#next_button').removeClass('disabled');
                    }
                } else {
                    $('#next_button').addClass('disabled');
                }

                if (!$('#submit_button').hasClass('disabled')) {
                    $('#next_button').addClass('disabled');
                }

            });

            $('#next_button').click(function() {

                if (!$(this).hasClass('disabled')) {

                    var step = $('body').attr('data-step');
                    var next_step = $('body').attr('data-next');

                    condition(step, next_step);

                    if (!next_step) {
                        next_step = parseFloat(step) + 1;
                    }

                    if (next_step == 0) {
                        next_step = parseFloat(step) + 1;
                        $('#submit_button').removeClass('disabled');
                        $('#next_button').addClass('disabled');
                    } else {
                        $('body').attr('data-next', parseFloat(next_step) + 1);
                    }

                    $('body').attr('data-step', next_step);

                    next(step, next_step);

                    $('.survey_step').hide();
                    $('.survey_step[data-step="'+next_step+'"]').show();

                    if (!$('#submit_button').hasClass('disabled')) {
                        $('#next_button').addClass('disabled');
                    }

                }

                return false;

            });

            $('#back_button').click(function() {

                if (!$(this).hasClass('disabled')) {

                    var step = $('body').attr('data-step');
                    var prev_step = $('body').attr('data-prev');

                    back(step, prev_step);

                    $('.survey_step').hide();
                    $('.survey_step[data-step="'+prev_step+'"]').show();

                    condition(prev_step, step);
                }

                return false;

            });

            $('#submit_button').click(function() {
                if ($(this).hasClass('disabled')) {
                    return false;
                }
            });

        });
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
    <style>
        .survey_step {
            display: none;
        }

        .survey_step[data-step="1"] {
            display: block;
        }

        label {
            font-size: 15px;
        }
    </style>
@endpush