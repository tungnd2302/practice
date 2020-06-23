<!DOCTYPE html>
<html>
<head>
  @include('admin.elements.top_head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  @include('admin.elements.top_nav')
  @include('admin.elements.sidebar')
  @yield('content')
  @include('admin.elements.footer')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
@include('admin.elements.script')
</body>
</html>
