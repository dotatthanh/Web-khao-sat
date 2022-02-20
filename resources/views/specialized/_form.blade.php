<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>

        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="code">Mã chuyên ngành <span class="text-danger">*</span></label>
                    <input id="code" name="code" type="text" class="form-control" placeholder="Mã ngành" value="{{ old('code', $data_edit->ma_nganh ?? '') }}">
                    {!! $errors->first('code', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">Tên chuyên ngành <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Tên chuyên ngành" value="{{ old('name', $data_edit->ten_nganh ?? '') }}">
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
            <a href="{{ route('specialized.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>

</div>