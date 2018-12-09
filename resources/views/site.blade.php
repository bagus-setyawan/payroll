<!DOCTYPE html>
<html>
@include('layouts.header')
<body class="hold-transition skin-blue-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
@include('layouts.menu')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
		  @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
@include('layouts.footer')
@include('layouts.script')
<script>
    @yield('script')
</script>
</body>
</html>