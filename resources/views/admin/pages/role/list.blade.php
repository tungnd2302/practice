@php
    use App\Helpers\Practice;
@endphp
<div class="card-body x_filter">
    <div class="row">
        <div class="col-md-12">
            @include('admin.templates.practice_notify')
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
                        @foreach ($items as $key => $item)
                            @php

                                $name = $item['name'];
                                $buttonChangeStatus = Practice::ShowStatusButton($controllerName,$item['status'],$item['id']);
                                $buttonAction       = Practice::ShowActionButton($controllerName,$item['id']);
                                $created = $item['created'];
                            @endphp
                            <tr>
                                <td>{{ $items->firstItem() + $key }}</td>
                                <td>{{ $name }}</td>
                                <td>{{ $created }}</td>
                                <td>{!! $buttonChangeStatus !!}</td>
                                <td>{!! $buttonAction !!}</td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
            </table>
            @if ($items->hasMorePages())
                {{ $items->links() }}
            @endif

        </div>
    </div>
</div>
