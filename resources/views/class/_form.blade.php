<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>

        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="specialized_id">Chuyên ngành <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="specialized_id">
                        <option value="">Chọn chuyên ngành</option>
                        @foreach ($specialized as $data)
                            <option value="{{ $data->id }}" {{ isset($data_edit->nganh_id) && $data_edit->nganh_id == $data->id ? 'selected' : '' }}>{{ $data->ten_nganh }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('specialized_id', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="code">Mã lớp học <span class="text-danger">*</span></label>
                    <input id="code" name="code" type="text" class="form-control" placeholder="Mã ngành" value="{{ old('code', $data_edit->ma_lop ?? '') }}">
                    {!! $errors->first('code', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="ten_lop">Tên lớp học <span class="text-danger">*</span></label>
                    <input id="ten_lop" name="ten_lop" type="text" class="form-control" placeholder="Tên chuyên ngành" value="{{ old('ten_lop', $data_edit->ten_lop ?? '') }}">
                    {!! $errors->first('ten_lop', '<span class="error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>

</div>