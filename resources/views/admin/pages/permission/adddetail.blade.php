@extends('admin.main')
@section('content')
@php
    $arrayTemplate = config('myapp.template.buttonChangeStatus');
    $name     = (isset($items['name'])) ? $items['name'] : '';
    $id       = (isset($id)) ? $id : '';
    $status   = (isset($items['status'])) ? $items['status'] : '';
    $title    = (isset($actionsModel[0]['scope'])) ? "Chỉnh sửa" : "Tạo mới";
    $scope    = (isset($actionsModel[0]['scope'])) ? $actionsModel[0]['scope'] : "";
    // $title    = (isset($items['id'])) ? "Chỉnh sửa" : "Tạo mới";

    use App\Helpers\Practice;
    $scopes = config('myapp.scope');
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
                        <div class="form-group">
                            {!! Form::label('Phạm vi quyền được áp dụng'); !!}
                            {!! Form::select('scope',$scopes,$scope, ['class' => 'form-control'] ) !!}
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

