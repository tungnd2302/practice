@extends('admin.main')
@section('content')
@php
    $statusTemplateList = config('myapp.template.buttonChangeStatus');
    $username      = $items['user']['fullname'];
    $role          = $items['role']['name'];
    //id
    $id = $items['user']['id'];
    // Trạng thắi
    $currentStatus = $items['user']['status'];
    $titleStatus   = $statusTemplateList[$currentStatus]['name'];
    // Ngày sinh
    $birthday      = (empty($items['user']['birthday'])) ? 'Chưa cập nhật' : $items['user']['birthday'];
    // Email
    $email         = (empty($items['user']['email'])) ? 'Chưa cập nhật' : $items['user']['email'];
    // Created
    $created         = (empty($items['user']['created'])) ? 'Chưa cập nhật' : date('d-m-Y',strtotime($items['user']['created']));
// buttonChangeStatus $statusTemplateList
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
                            <span>Tên người dùng:</span>
                            <span>{{ $username }}</span>
                        </p>
                        <p class="mt-1">
                            <span>Chức vụ:</span>
                            <span>{{ $role }}</span>
                        </p>
                        <p class="mt-1">
                            <span>Trạng thái tài khoản:</span>
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
                        <a href="" class="btn btn-danger w-100">Đổi mật khẩu</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-info">
                        <span>Thông tin Chi tiết</span>
                    </div>
                    <div class="card-body text-center">
                        <p class="mt-3 d-flex">
                            <span>Ngày sinh:</span>
                            <span class="ml-auto badge badge-danger">{{ $birthday }}</span>
                        </p>
                        <p class="mt-3 d-flex">
                            <span>Địa chỉ email</span>
                            <span class="ml-auto badge badge-danger">{{ $email }}</span>
                        </p>
                        <p class="mt-3 d-flex">
                            <span>Ngày kích hoạt tài khoản:</span>
                            <span class="ml-auto">{{ $created }}</span>
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <span>Work flow</span>
                    </div>
                    <div class="card-body text-center">
                        <p>Comming soon</p>
                    </div>
                </div>

            </div>
           </div>
        </div>
      </section>

  </div>


@endsection

