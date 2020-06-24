@extends('admin.main')
@section('content')
@php
    $arrayTemplate = config('myapp.template.buttonChangeStatus');
    $name     = (isset($items['name'])) ? $items['name'] : '';
    $id       = (isset($items['id'])) ? $items['id'] : '';
    $status   = (isset($items['status'])) ? $items['status'] : '';
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.title', ['title' => 'Chức vụ'])
    <section class="content">
      <div class="container-fluid">
            <div class="card">
                @include('admin.partials.card_title',['title' => 'Tạo mới chức vụ chức vụ','form' => false])
                <div class="card-body x_filter">
                    @include('admin.templates.error')
                    {!! Form::open(['route' => $controllerName."save" , 'class' => 'form-group']) !!}
                    {{ Form::hidden('id', $id) }}
                    <div class="form-group">
                        {!! Form::label('Tên chức vụ'); !!}
                        {!! Form::text('name',$name, ['class' => 'form-control'] ) !!}
                    </div>
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

