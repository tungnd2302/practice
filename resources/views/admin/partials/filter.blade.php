@php
    use App\Helpers\Practice;
    $showStatusButton = Practice::countStatus($status,$controllerName,$params);
    $controllerSeacrh    = config('myapp.template.search');
    $fieldSearchTemplate = config('myapp.template.searchField');
    $fieldSearch         = (isset($params['fieldSearch'])) ? $params['fieldSearch'] : '';
    $paramSearchField    = (isset($params['fieldSearch'])) ? $fieldSearchTemplate[$params['fieldSearch']] : 'Tìm kiếm';
    $paramContentField    = (isset($params['contentSearch'])) ? $params['contentSearch'] : '';

    $searchs = array_key_exists($controllerName,$controllerSeacrh) ? $controllerSeacrh[$controllerName] : $controllerSeacrh['unknow'] ;
    // echo '<pre>';
    // print_r($searchs);
    // echo'</pre>';
    // die;

@endphp
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
                <button type="button" class="btn btn-default dropdown-toggle c-no-border-radius" data-toggle="dropdown" id="contentSearch"  data-field="{{ $fieldSearch }}">
                {{ $paramSearchField }}
                </button>
                <div class="dropdown-menu">
                    @foreach ($searchs as $item)
                        @php
                            $name = $fieldSearchTemplate[$item];
                        @endphp
                        <a class="dropdown-item searchfield" href="#" data-field="{{ $item }}" >{{ $name }}</a>
                    @endforeach

                </div>
            </div>
        <input type="text" name="search" class="form-control c-no-border-radius c-no-border-left w-50" value="{{ $paramContentField }}">
            <button type="button" class="btn btn-danger c-no-border-radius" id="searchButton">
                <i class="fa fa-search"></i>
            </button>
        </div>

        <div class="col-md-6 d-flex">
            {!! $showStatusButton !!}
        </div>
      </div>


    </div>
    <!-- /.card-body -->
</div>
