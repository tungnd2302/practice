@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.title', ['title' => 'Quyền','back' => false])
    <section class="content">
      <div class="container-fluid">
            @include('admin.partials.filter')
            <div class="card">
                @include('admin.partials.card_title',['title' => 'Danh sách Quyền','model' => App\Models\Backend\Permission::class,'form' => true])
                @include('admin.pages.'.$controllerName.'.list')
                <div class="card-footer">
                  Footer
                </div>
                <!-- /.card-body -->
            </div>

      </div>
    </section>

  </div>


@endsection

