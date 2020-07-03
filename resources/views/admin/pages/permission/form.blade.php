@extends('admin.main')
@section('content')
@php
    $arrayTemplate = config('myapp.template.buttonChangeStatus');
    // $name     = (isset($items['name'])) ? $items['name'] : '';
    $scopes   = config('myapp.scope');
    $id       = (isset($items['id'])) ? $items['id'] : '';
    $status   = (isset($items['status'])) ? $items['status'] : '';
    $title    = (isset($items['id'])) ? "Chỉnh sửa" : "Tạo mới";
    $scope    = (isset($items['scope'])) ? $items['scope'] : '';
    $name     = (isset($items['name'])) ? $items['name'] : '';


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
                        {!! Form::label('Tên quyền'); !!}
                        {!! Form::text('name',$name, ['class' => 'form-control'] ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Phạm vi áp dụng'); !!}
                        {!! Form::select('scope',$scopes,$scope,['class' => 'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Hành động'); !!} <br/>
                        @php
                            $checkedView = '';
                            $checkedAdd = '';
                            $checkedEdit = '';
                            $checkedDelete = '';

                        @endphp
                        @foreach ($actionsModel as $item)
                            @php
                                $checkedView = ($item['action'] == 'view') ? "checked" : $checkedView;
                                $checkedAdd = ($item['action'] == 'add') ? "checked" : $checkedAdd;
                                $checkedEdit = ($item['action'] == 'edit') ? "checked" : $checkedEdit;
                                $checkedDelete = ($item['action'] == 'delete') ? "checked" : $checkedDelete;
                            @endphp
                        @endforeach

                        {!! Form::checkbox('action[]', 'view',$checkedView) !!} Xem &nbsp; &nbsp; &nbsp; &nbsp;
                        {!! Form::checkbox('action[]', 'add',$checkedAdd) !!} Thêm &nbsp; &nbsp; &nbsp; &nbsp;
                        {!! Form::checkbox('action[]', 'edit',$checkedEdit) !!} Sửa &nbsp; &nbsp; &nbsp; &nbsp;
                        {!! Form::checkbox('action[]', 'delete',$checkedDelete) !!} Xóa &nbsp; &nbsp; &nbsp; &nbsp;
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

