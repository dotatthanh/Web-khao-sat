<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>

        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Tên câu hỏi <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="VD: Câu 1" value="{{ old('name', $data_edit->ten ?? '') }}">
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="content">Nội dung <span class="text-danger">*</span></label>
                    <input id="content" name="content" type="text" class="form-control" placeholder="Nội dung" value="{{ old('content', $data_edit->noi_dung ?? '') }}">
                    {!! $errors->first('content', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="type">Cách chọn đáp án <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="type">
                        <option value="">Chọn cách chọn đáp án</option>
                        <option value="0" {{ isset($data_edit->cach_chon_dap_an) && $data_edit->cach_chon_dap_an == '0' ? 'selected' : '' }}>Chọn 1 đáp án</option>
                        <option value="1" {{ isset($data_edit->cach_chon_dap_an) && $data_edit->cach_chon_dap_an == '1' ? 'selected' : '' }}>Chọn nhiều đáp án</option>
                    </select>
                    {!! $errors->first('type', '<span class="error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <h4 class="card-title">Phương án trả lời</h4>
        {!! $errors->first('answers', '<span class="error">:message</span>') !!}

        <div data-repeater-list="answers">
            @if (isset($data_edit))
                @foreach ($data_edit->answers as $answer)
                <div data-repeater-item class="row">
                    <div class="form-group col-lg-3 custom-validate-select">
                        <label for="name">Tên phương án <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" name="name" class="form-control" required data-parsley-maxlength="10" placeholder="VD: A, B" value="{{ $answer->ten }}">
                    </div>

                    <div class="form-group col-lg-8">
                        <label for="content">Nội dung <span class="text-danger">*</span></label>
                        <input type="text" id="content" name="content" name="content" class="form-control" required placeholder="Nội dung" data-parsley-maxlength="255" value="{{ $answer->noi_dung }}">
                    </div>

                    <div class="col-lg-1">
                        <label>Thao tác</label>
                        <input data-repeater-delete="" type="button" class="btn btn-danger btn-block" value="Xóa">
                    </div>
                </div>
                @endforeach
            @else
            <div data-repeater-item="" class="row">
                <div class="form-group col-lg-3 custom-validate-select">
                    <label for="name">Tên phương án <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" name="name" class="form-control" required data-parsley-maxlength="10" placeholder="VD: A, B">
                </div>

                <div class="form-group col-lg-8">
                    <label for="content">Nội dung <span class="text-danger">*</span></label>
                    <input type="text" id="content" name="content" name="content" class="form-control" required placeholder="Nội dung" data-parsley-maxlength="255">
                </div>

                <div class="col-lg-1">
                    <label>Thao tác</label>
                    <input data-repeater-delete="" type="button" class="btn btn-danger btn-block" value="Xóa">
                </div>
            </div>
            @endif
        </div>
        <input data-repeater-create="" type="button" class="btn btn-success mt-3 mt-lg-0" value="Thêm">
    </div>
</div>

<div class="card">
    <div class="card-body">
            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
            <a href="{{ route('questions.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>

</div>