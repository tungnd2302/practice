@extends('admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.title', ['title' => 'Chức vụ'])


    <section class="content">
      <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Phân loại</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body x_filter">
                  <div class="row">
                    <div class="col-md-4 d-flex">
                      <div class="dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle c-no-border-radius" data-toggle="dropdown">
                          Tìm kiếm
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Link 1</a>
                          <a class="dropdown-item" href="#">Link 2</a>
                          <a class="dropdown-item" href="#">Link 3</a>
                        </div>
                      </div>
                      <input type="text" name="search" class="form-control c-no-border-radius c-no-border-left">
                    </div>

                    <div class="col-md-6 d-flex">
                        <a href="" class="btn btn-danger mr-1">
                            Toàn bộ <span class="badge badge-light">4</span>
                        </a>
                        <a href="" class="btn btn-primary mr-1">
                            Chưa kích hoạt <span class="badge badge-light">3</span>
                        </a>
                        <a href="" class="btn btn-primary mr-1">
                            Kích hoạt <span class="badge badge-light">1</span>
                        </a>
                    </div>
                  </div>


                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Danh sách chức vụ</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body x_filter">
                  <div class="row">
                    <div class="col-md-12 d-flex">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                <td>#</td>
                                <td>Tên chức vụ</td>
                                <td>Trạng thái</td>
                                <td>Ngày tạo</td>
                                <td>Thao tác</td>
                              </tr>
                          </thead>
                      </table>
                    </div>
                  </div>
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

