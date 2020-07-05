<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Chức vụ và quyền hạn
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('index', App\Models\Backend\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('role') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Chức vụ</p>
                            </a>
                        </li>
                    @endcan
                    @can('index', App\Models\Backend\Permission::class)
                    <li class="nav-item">
                        <a href="{{ route('permission') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quyền</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            @can('index', App\Models\Backend\User::class)
            <li class="nav-item">
                <a href="{{ route('user') }}" class="nav-link">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        Danh sách người dùng
                    </p>
                </a>
            </li>
            @endcan

            @can('index', App\Models\Backend\Question_suite::class)
            <li class="nav-item">
                <a href="{{ route('questionsuite') }}" class="nav-link">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        Danh sách bộ đề
                    </p>
                </a>
            </li>
            @endcan
             {{--<li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        Danh sách câu hỏi
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        Danh sách tài khoản
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon fa fa-tachometer-alt"></i>
                    <p>
                        Tùy chọn hệ thống
                    </p>
                </a>
            </li> --}}
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
