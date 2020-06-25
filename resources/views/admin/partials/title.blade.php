<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @if($back == true)
                <a href="{{ route($controllerName) }}">
                    <span class="fa fa-angle-left" style="font-size: 18px"></span>
                    <span style="font-size: 18px">Quay về</span>
                </a>
            @endif
            <h1 class="m-0 text-dark mt-2">{{ $title }}</h1>
          </div><!-- /.col -->
        </div>
      </div>
</div>
