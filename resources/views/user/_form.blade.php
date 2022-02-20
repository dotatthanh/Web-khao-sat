@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Họ và tên" value="{{ old('name', $data_edit->ten ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>

        @if ($routeType == 'create')
            <div class="form-group">
                <label for="userpassword">Mật khẩu <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="userpassword" placeholder="Nhập mật khẩu" autocomplete="new-password" name="password">
                {!! $errors->first('password', '<span class="error">:message</span>') !!}
            </div>
        @endif

    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email', $data_edit->email ?? '') }}">
            {!! $errors->first('email', '<span class="error">:message</span>') !!}
        </div>

        @if ($routeType == 'create')
            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="Nhập xác nhận mật khẩu" name="password_confirmation">        
            </div>
        @endif
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>