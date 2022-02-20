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
                                <h2 class="font-weight-bold text-center">NỘI DUNG KHẢO SÁT</h2>
                                <p class=" text-center">Tình hình việc làm của sinh viên Trường Đại học Trà Vinh sau khi tốt nghiệp</p>
                                <p>Anh/Chị vui lòng dành ít thời gian tham gia phiếu khảo sát này. Thông tin trả lời của Anh/Chị chỉ được sử dụng cho mục đích cải tiến hoạt động Dạy - Học và nâng cao cơ hội việc làm cho sinh viên sau tốt nghiệp.</p>

                                <p class="text-danger">Ngày trả lời khảo sát: {{ date('d-m-Y') }}</p>

                                <form action="{{ route('surveys.store') }}" class="position-relative" method="POST">
                                    @csrf
                                    <h3>A. THÔNG TIN CÁ NHÂN</h3>

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

                  <h3>B. THÔNG TIN VỀ TÌNH HÌNH VIỆC LÀM</h3>

                  @php
                  $stt = -1;
                  @endphp
                  <div class="questions pl-3 position-relative">
                    @foreach ($questions as $question)
                    @php
                    $stt++;
                    @endphp
                    <div class="question" id="answers{{ $stt }}">
                        <h5 class="text-danger">{{ $question->ten }}: {{ $question->noi_dung }}</h5>
                        @foreach ($question->answers as $answer)
                        <div class="pl-3">
                            @if ($question->cach_chon_dap_an == 1)
                            <input type="checkbox" name="answers[{{ $stt }}][{{ $question->id }}][{{ $answer->id }}]" value="{{ $answer->id }}" id="answer{{ $answer->id }}" onclick="checked_checkbox_input($(this), 'checked_answer{{ $answer->id }}', {{ $question }})">

                            <input type="checkbox" name="check_answers[{{ $stt }}][{{ $question->id }}]" id="checked_answer{{ $answer->id }}" hidden>
                            @else
                            <input type="radio" name="answers[{{ $stt }}][{{ $question->id }}]" value="{{ $answer->id }}" id="answer{{ $answer->id }}" onchange="get_result({{ $question }}, {{ $answer }}); rm_disabled();" onclick="checked_checkbox_input($(this), 'answers{{ $answer->id }}', {{ $question }})">
                            @endif
                            <label for="answer{{ $answer->id }}">{{ $answer->ten }}: {{ $answer->noi_dung }}</label>
                        </div>

                        @endforeach
                    </div>
                    @endforeach
                </div>

                <button disabled class="btn btn-primary position-absolute btn-done" type="submit">Hoàn tất</button>
                <a class="btn btn-primary position-absolute btn-exit" href="{{ route('surveys.index') }}">Thoát</a>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Skote.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
@endsection

@push('js')

    <script src="{{ asset('slick/slick.js') }}"></script>
    <script>
        let slick = $('.questions').slick({
            infinite: false,
            draggable: false,
            prevArrow: '<button type="button" disabled class="slick-prev btn btn-primary position-absolute" onclick="disabled_btn_prev()">Quay lại</button>',
            nextArrow: '<button type="button" disabled class="slick-next btn btn-primary position-absolute"  onclick="disabled_btn_next()">Tiếp tục</button>',
        });

        let questions = JSON.parse(`<?= json_encode($questions) ?>`);
        let amount_question = JSON.parse(`<?= $questions->count() ?>`);
        let stt = 0;

        let result_question_1 = '';
        let result_question_8 = '';

        function get_result(question, answer) {
            // Câu 7
            if ($(`input[name="answers[0][${questions[0].id}]"]:checked`).prop('checked', true) && stt == 0) {
                result_question_1 = answer.noi_dung;
            }

            // Câu 8
            if ($(`input[name="answers[7][${questions[7].id}]"]:checked`).prop('checked', true) && stt == 7) {
                result_question_8 = answer.noi_dung;
            }
        }

        function rm_disabled() {

            if (stt == 0) {
                $(`.slick-prev`).attr('disabled', 'disabled');
                $(`.slick-next`).removeAttr('disabled');
            }
            else if(stt == amount_question-1) {
                $(`.slick-next`).attr('disabled', 'disabled');
                $(`.slick-prev`).removeAttr('disabled');
                $(`.btn-done`).removeAttr('disabled');
            }
            else {
                // $(`.slick-next`).removeAttr('disabled');
                $(`.slick-prev`).removeAttr('disabled');
            }
        }

        function checked_checkbox_input(obj, name_id, question) {
            if (obj.is(':checked')) {
                $(`#${name_id}`).prop('checked', true);
                $(`.slick-next`).removeAttr('disabled');
            }
            else {
                $(`#${name_id}`).prop('checked', false);
            }

            if ($(`input[name="check_answers[${stt}][${question.id}]"]:checked`).length > 0 || $(`input[name="answers[${stt}][${question.id}]"]:checked`).is(':checked')) {
                rm_disabled();
            }
            else {
                $(`.slick-next`).attr('disabled', 'disabled');
                $(`.slick-prev`).attr('disabled', 'disabled');
            }
        }

        function disabled_btn_next() {
            
            // Điều kiện câu 2
            if (stt == 0 && result_question_1 == 'Chưa có việc làm' || result_question_1 == 'Chưa có nhu cầu') {
                // $(`.btn-done`).removeAttr('disabled');
                $(`.slick-next`).attr('disabled', 'disabled');
                $(`.btn-done`).removeAttr('disabled');
            // //     // $(`.slick-prev`).removeAttr('disabled');
            // //     // rm_disabled();
            }
            else {
                // $('.questions').slick('slickGoTo', 2);
                // slick.slick('slickGoTo', 2);
                stt++;
                if ($(`input[name="check_answers[${stt}][${questions[stt].id}]"]:checked`).length > 0 || $(`input[name="answers[${stt}][${questions[stt].id}]"]:checked`).is(':checked')) {
                    $(`.slick-next`).removeAttr('disabled');
                }
                else {
                    $(`.slick-next`).attr('disabled', 'disabled');
                }

                $(`.slick-prev`).removeAttr('disabled');
                rm_disabled();
            }

        }

        function disabled_btn_prev() {
            stt--;
            rm_disabled();
            $(`.slick-next`).removeAttr('disabled');
        }
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
    <style>
        .slick-prev {
            bottom: 0;
            left: 0;
        }

        .slick-next {
            bottom: 0;
            left: 93px;
        }

        .btn-done {
            bottom: 0;
            left: 184px;
        }

        .btn-exit {
            bottom: 0;
            left: 280px;
        }

        .questions {
            padding-bottom: 50px;
        }
    </style>
@endpush