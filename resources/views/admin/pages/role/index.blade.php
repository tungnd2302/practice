@extends('admin.main')
@section('content')
@php
    use App\Helpers\Practice;
@endphp
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.title', ['title' => 'Chức vụ'])
    <section class="content">
      <div class="container-fluid">
            @include('admin.partials.filter')
            <div class="card">
                @include('admin.partials.card_title',['title' => 'Danh sách chức vụ','form' => true])
                <div class="card-body x_filter">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Tên chức vụ</td>
                                    <td>Ngày tạo</td>
                                    <td>Trạng thái</td>
                                    <td>Thao tác</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($items) < 1)
                                    <tr>
                                        <td colspan="5" class="text-bold">Không có dữ liệu</td>
                                    </tr>
                                @else
                                    @foreach ($items as $item)
                                        @php

                                            $name = $item['name'];
                                            $buttonChangeStatus = Practice::ShowStatusButton($controllerName,$item['status'],$item['id']);
                                            $buttonAction       = Practice::ShowActionButton($controllerName,$item['id']);
                                            $created = $item['created'];
                                        @endphp
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $name }}</td>
                                            <td>{{ $created }}</td>
                                            <td>{!! $buttonChangeStatus !!}</td>
                                            <td>{!! $buttonAction !!}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $items->links() }}
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

