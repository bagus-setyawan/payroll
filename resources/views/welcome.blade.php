
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Top Navigation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/libs/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/libs/ionicons.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("assets/plugins/datatables/dataTables.bootstrap.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/skin-blue-light.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .swal2-popup {
        font-size: 1.6rem !important;
    }
    </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue-light layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand"><b>{{ env('APP_NAME') }}</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            @if (Auth::check())
                <form action="{{ url('logout') }}" method="post" id="logoutForm">
                    @csrf
                </form>
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li><a href="#" onclick="document.getElementById('logoutForm').submit()">Logout</a></li>
            @else
                <li><a href="{{ url('login') }}">Login</a></li>
            @endif
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Presensi QR Code
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3>Silahkan scan QR Code yang ada pada kartu anggota anda</h3>
                        <small class="text-danger">*Foto absen anda terkirim ke admin, jangan coba-coba titip absen</small>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-md-4">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Preview</h3>
                    </div>
                    <div class="box-body" style="padding:0;">
                        <video id="preview" style="width:100%;height:auto;"></video>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary btn-md" onclick="startPreview()"><i class="fa fa-dashboard"></i> Start</button>
                        <button class="btn btn-danger btn-md" onclick="stopPreview()"><i class="fa fa-close"></i> Stop</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Foto</h3>
                    </div>
                    <div class="box-body">
                        <dl>
                            <dd><center><img id="foto" src="{{ asset('assets/images/placeholder.jpg') }}" alt="" class="img-responsive"></center></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Biodata</h3>
                    </div>
                    <div class="box-body">
                        <dl>
                            <dt>Nama</dt>
                            <dd><input id="nama" type="text" class="form-control" value=""></dd>
                            <dt>ID</dt>
                            <dd><input id="id" type="text" class="form-control" value=""></dd>
                            <dt>Presensi</dt>
                            <dd><input id="presensi" type="text" class="form-control" value=""></dd>
                            <dt>Terlambat</dt>
                            <dd><input id="terlambat" type="text" class="form-control" value=""></dd>
                            <dt>Lembur</dt>
                            <dd><input id="lembur" type="text" class="form-control" value=""></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- Tabel absensi --}}
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Presensi Hari ini {{ $now }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id User</th>
                                    <th>Nama</th>
                                    <th>Absen Masuk</th>
                                    <th>Absen Pulang</th>
                                    <th>Lembur</th>
                                    <th>Telat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensis as $absensi)
                                    <tr>
                                        <td>{{ $absensi->user->id }}</td>
                                        <td>{{ $absensi->user->name }}</td>
                                        <td>{{ $absensi->absen_masuk }}</td>
                                        <td>{{ $absensi->absen_pulang }}</td>
                                        <td>{{ $absensi->lama_lembur.' jam' }}</td>
                                        <td>{{ $absensi->lama_telat.' jam' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.7
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('assets/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
<!-- QR Scanner -->
<script src="{{ asset('assets/js/instascan.min.js') }}"></script>
<!-- Sweet Alert 2 -->
<script src="{{ asset('assets/js/sweetalert2.all.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- Custom -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>
    var tbl = $('table').dataTable({
        scrollX: true,
        order: [[2, 'asc']]
    });
    var scanner = new Instascan.Scanner({ 
        video: document.getElementById('preview'),
        captureImage: true
     });
    scanner.addListener('scan', function (content, image) {
        $.ajax({
            type: 'POST',
            url: '{{ url('presensi/check') }}',
            dataType: 'JSON',
            data: {
                email: content,
                capture: image,
                _token: '{{ csrf_token() }}'
            },
            success: function(res){
                resetBiodata();
                if (res.error) {
                    notif({
                        type: 'error',
                        title: res.msg
                    });
                } else {
                    $('#foto').attr('src', res.foto);
                    $('#nama').val(res.name);
                    $('#id').val(res.id);
                    $('#presensi').val(res.presensi);
                    $('#terlambat').val(res.terlambat);
                    $('#lembur').val(res.lembur);

                    notif({
                        type: 'success',
                        title: res.msg
                    });
                    get_absen_data();
                }
            },
            error: function(error){
                console.log(error);
            }
        })
    });

    function startPreview() {
        Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
            notif({
                type: 'success',
                title: 'Presensi aktif!'
            });
        } else {
            notif({
                type: 'warning',
                title: 'Kamera tidak ditemukan'
            });
        }
        }).catch(function (e) {
            notif({
                type: 'danger',
                title: e
            });
        });
    }

    function stopPreview() {
        if (scanner != null) {
            scanner.stop();
        }
    }

    function resetBiodata() {
        $('#foto').attr('src', '{{ asset('assets/images/placeholder.jpg') }}');
        $('#nama').val('');
        $('#id').val('');
        $('#presensi').val('');
        $('#terlambat').val('');
        $('#lembur').val('');
    }

    function get_absen_data(){
        $.ajax({
            url: '{{ url('presensi/absen_data') }}',
            type: 'GET',
            dataType: 'JSON',
            success: function(res){
                tbl.fnDestroy();
                $('tbody').html(res.data);
                tbl = $('table').dataTable({
                    scrollX: true,
                    order: [[2, 'asc']]
                });
            },
            error: function(err){
                console.log(err);
            }
        });
    }
</script>
</body>
</html>