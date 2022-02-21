<div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>

                @if (auth()->user()->admin == 1)
                    <li class="menu-title">Quản lý</li>
                    
                    <li>
                        <a href="{{ route('questions.index') }}" class=" waves-effect">
                            <i class="bx bx-question-mark"></i>
                            <span>Câu hỏi</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('specialized.index') }}" class=" waves-effect">
                            <i class="bx bxs-buildings"></i>
                            <span>Chuyên ngành</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('classes.index') }}" class=" waves-effect">
                            <i class="bx bxs-buildings"></i>
                            <span>Lớp học</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('users.index') }}" class=" waves-effect">
                            <i class="bx bx-user"></i>
                            <span>Tài khoản</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-cog"></i><span class="badge badge-pill badge-info float-right">03</span>
                            <span>Thống kê</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('statistic.year') }}">Thống kê trong năm</a></li>
                            <li><a href="{{ route('statistic.specialized') }}">Thống kê theo ngành</a></li>
                            <li><a href="{{ route('statistic.class') }}">Thống kê theo lớp</a></li>
                        </ul>
                    </li>
                @else
                    <li class="menu-title">Khảo sát</li>

                    <li>
                        <a href="{{ route('surveys.index') }}" class=" waves-effect">
                            <i class="bx bx-file"></i>
                            <span>Khảo sát</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>