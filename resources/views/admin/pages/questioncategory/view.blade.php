@extends('admin.main')
@section('content')
@php
    $statusTemplateList = config('myapp.template.buttonChangeStatus');
    $name = $item->name;
    $id = $item->id;
    $created = date('d-m-Y',strtotime($item->created));
    $titleStatus = ($item->status == 1) ? 'Đang hoạt động' : 'Dừng hoạt động';
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.title', ['title' => $nameInVN,'back' => true])
    <section class="content">
        <div class="container-fluid">
           <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info">
                        <span>Thông tin tổng quát</span>
                    </div>
                    <div class="card-body text-center">
                        <img class="card-img-top rounded-circle w-50" src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" alt="Card image" >
                        <p class="mt-3">
                            <span>Tên chức vụ:</span>
                            <span>{{ $name }}</span>
                        </p>
                        <p class="mt-1">
                            <span>Ngày tạo:</span>
                            <span>{{ $created }}</span>
                        </p>
                        <p class="mt-1">
                            <span>Trạng thái chức vụ:</span>
                            <span class="badge badge-primary">{{ $titleStatus }}</span>
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-info">
                        <span>Thao tác</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route($controllerName.'form',['id' => $id]) }}" class="btn btn-primary w-100 mb-3">Sửa thông tin</a>
                        {{-- <a href="" class="btn btn-danger w-100">Đổi mật khẩu</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-info">
                        <span>Quyền hạn</span>
                    </div>
                    <div class="card-body text-center">
                        @foreach ($item->permission as $per)
                            <p class="mt-3 d-flex">{{ $per->name }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <span>Members</span>
                    </div>
                    <div class="card-body text-center">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Họ tên</td>
                                    <td>Tài khoản</td>
                                    <td>Trạng thái</td>
                                    <td>Hành động</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    @php
                                        $userStatus = ($user->status == 1) ? 'Kích hoạt' : 'Không kích hoạt';
                                    @endphp
                                    <tr>
                                        <td>{{  $users->firstItem() + $key }}</td>
                                        <td>{{  $user['fullname'] }}</td>
                                        <td>{{  $user['username'] }}</td>
                                        <td>
                                            <span class="badge badge-primary">
                                            {{  $userStatus }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                            {{  $userStatus }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
           </div>
        </div>
      </section>

  </div>


@endsection

