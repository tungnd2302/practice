@extends('admin.main')
@section('content')
@php
    $arrayTemplate = config('myapp.template.buttonChangeStatus');
    $name     = (isset($items['name'])) ? $items['name'] : '';
    $id       = (isset($items['id'])) ? $items['id'] : '';
    $status   = (isset($items['status'])) ? $items['status'] : '';
    $title    = (isset($items['id'])) ? "Chỉnh sửa" : "Tạo mới";

    use App\Helpers\Practice;
    $showPermission = Practice::addPermission();
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.title', ['title' => $nameInVN,'back' => true])
    <section class="content">
      <div class="container-fluid">
            <div class="card">
                @include('admin.partials.card_title',['title' => $title . ' ' . $nameInVN,'form' => false])
                {!! Form::open(['route' => $controllerName."saveedit" , 'class' => 'form-group']) !!}
                {{ Form::hidden('id', $id) }}
                    <div class="card-body x_filter">
                        {!! $showPermission !!}
                    </div>
                    <div class="card-footer">
                        {!!  Form::submit('Lưu', ['class' => 'btn btn-primary']); !!}
                    </div>
                {{ Form::close() }}
                <!-- /.card-body -->
            </div>

      </div>
    </section>

  </div>


@endsection

