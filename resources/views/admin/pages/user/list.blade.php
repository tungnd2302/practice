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
                        <td>Username</td>
                        <td>Họ tên</td>
                        <td>Chức vụ</td>
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
                                $fullname = $item['fullname'];
                                $buttonChangeStatus = Practice::ShowStatusButton($controllerName,$item['status'],$item['id']);
                                $buttonAction       = Practice::ShowActionButton($controllerName,$item['id']);
                                $created = $item['created'];
                                $username = $item['username'];
                                $rolename   = $item['rolename'];
                            @endphp
                            <tr>
                                <td>{{ $items->firstItem() + $key }}</td>
                                <td>{{ $username }}</td>
                                <td>{{ $fullname }}</td>
                                <td>{{ $rolename }}</td>
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
