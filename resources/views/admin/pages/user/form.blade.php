@extends('admin.main')
@section('content')
@php
    $arrayTemplate = config('myapp.template.buttonChangeStatus');
    $unknowRole    = config('myapp.unknow.role');
    $id       = (isset($item->id)) ? $item->id : '';
    $username = (isset($item->username)) ? $item->username :  '';
    $fullname = (isset($item->fullname)) ? $item->fullname :  '';
    $status   = (isset($item->status))   ? $item->status :    '';
    $roleid   = (isset($item->roles->id)) ? $item->roles->id : '';
    $title    = (isset($item->id)) ? "Chỉnh sửa" : "Tạo mới";
    $roles    = (count($roles) < 1) ? $unknowRole : $roles;
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.title', ['title' => $nameInVN,'back' => true])
    <section class="content">
      <div class="container-fluid">
            <div class="card">
                @include('admin.partials.card_title',['title' => $title . ' ' . $nameInVN,'form' => false])
                <div class="card-body x_filter">
                    @include('admin.templates.error')
                    {!! Form::open(['route' => $controllerName."save" , 'class' => 'form-group']) !!}
                    {{ Form::hidden('id', $id) }}
                    <div class="form-group">
                        {!! Form::label('Tài khoản'); !!}
                        {!! Form::text('username',$username, ['class' => 'form-control'] ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Tên người dùng'); !!}
                        {!! Form::text('fullname',$fullname, ['class' => 'form-control'] ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Chức vụ'); !!}
                        {!! Form::select('roleid', $roles ,$roleid,['class' => 'form-control']); !!}
                    </div>
                    @if ($id == '')
                        <div class="form-group">
                            {!! Form::label('Mật khẩu'); !!}
                            {!! Form::password('password', ['class' => 'form-control'] ) !!}
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('Trạng thái'); !!}
                        {!! Form::select('status', ['1' => $arrayTemplate[1]['name'], '0' => $arrayTemplate[0]['name']],$status,['class' => 'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!!  Form::submit('Lưu', ['class' => 'btn btn-primary']); !!}
                        <a href="{{ route($controllerName) }}" class="btn btn-default">Hủy bỏ</a>
                    </div>

                    {!! Form::close() !!}
                </div>
                <div class="card-footer">
                  Footer
                </div>
                <!-- /.card-body -->
            </div>

      </div>
    </section>

  </div>


@endsection

