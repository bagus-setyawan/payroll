@extends('site')

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (Session::has('msg'))
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-bell-o"></i> Info!</h4>
                    {!! session('msg') !!}
                </div>
            @endif
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">Data Presensi</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Id User</th>
                                <th>Nama</th>
                                <th>Jam Datang</th>
                                <th>Jam Pulang</th>
                                <th>Lama Lembur</th>
                                <th>Lama Telat</th>
                                <th>Foto Masuk</th>
                                <th>Foto Pulang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensis as $presensi)
                                <tr>
                                    <td>{{ $presensi->id }}</td>
                                    <td>{{ $presensi->user->id }}</td>
                                    <td>{{ $presensi->user->name }}</td>
                                    <td>{{ $presensi->absen_masuk }}</td>
                                    <td>{{ $presensi->absen_pulang }}</td>
                                    <td>{{ $presensi->lama_lembur }} jam</td>
                                    <td>{{ $presensi->lama_telat }} jam</td>
                                    <td><img src="{{ $presensi->capture_masuk }}" class="img-responsive" alt="" style="width:100px;height:70px;"></td>
                                    <td><img src="{{ $presensi->capture_pulang }}" class="img-responsive" alt="" style="width:100px;height:70px;"></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="edit('{{ $presensi->id }}')"><i class="fa fa-pencil"></i> Edit</button>
                                        <form action="{{ url('data/presensi/delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $presensi->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">Update</h3>
                </div>
                <div class="box-body">
                    <form action="{{ url('data/presensi/update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="" required>
                        <div class="form-group">
                            <label for="">Id User</label>
                            <input type="text" class="form-control" name="user_id" placeholder="id" value="" disabled required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" placeholder="nama" value="" disabled required>
                        </div>
                        <div class="form-group">
                            <label for="">Jam Datang</label>
                            <input type="text" class="form-control" name="absen_masuk" placeholder="Jam masuk" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jam Pulang</label>
                            <input type="text" class="form-control" name="absen_pulang" placeholder="Jam pulang" required>
                        </div>
                        <div class="form-group">
                            <label for="">Lama Lembur</label>
                            <input type="number" class="form-control" name="lama_lembur" placeholder="Lama lembur" required>
                        </div>
                        <div class="form-group">
                            <label for="">Lama Telat</label>
                            <input type="number" class="form-control" name="lama_telat" placeholder="Lama telat" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save"></i> Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    function edit(id){
        $.ajax({
            url: '{{ url('data/presensi/show') }}',
            type: 'GET',
            data: {
                id:id
            },
            dataType: 'JSON',
            success: function(res){
                if(res){
                    console.log('true');
                    $("input[name=id]").val(res.id);
                    $("input[name=user_id]").val(res.user_id);
                    $("input[name=name]").val(res.user.name);
                    $("input[name=absen_masuk]").val(res.absen_masuk);
                    $("input[name=absen_pulang]").val(res.absen_pulang);
                    $("input[name=lama_lembur]").val(res.lama_lembur);
                    $("input[name=lama_telat]").val(res.lama_telat);

                    notif({
                        type: 'success',
                        title: 'Data ditampilkan'
                    });
                }
            },
            error: function(error){
                console.log(error);
                notif({
                    type: 'error',
                    title: 'Gagal mengambil data'
                });
            }
        });
    }
@endsection