@extends('admin.main')
@section('content')
@php
    $arrayTemplate = config('myapp.template.buttonChangeStatus');
    $id       = (isset($items['user']['id'])) ? $items['user']['id'] : '';
    $username = (isset($items['user']['username'])) ? $items['user']['username'] : '';
    $fullname = (isset($items['user']['fullname'])) ? $items['user']['fullname'] : '';
    $status   = (isset($items['user']['status'])) ? $items['user']['status'] : '';
    $roleid   = (isset($items['user']['id'])) ? $items['user']['id'] : '';
    $title    = (isset($items['user']['id'])) ? "Chỉnh sửa" : "Tạo mới";

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

