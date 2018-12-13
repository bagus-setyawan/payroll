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
                    <h3 class="box-title">Data User</h3>
                    <button class="btn btn-default btn-sm pull-right" style="background-color:orange;" onclick="window.open('{{ url('data/user/cetak') }}', '_blank')"><i class="fa fa-print"></i> Cetak Kartu</button>
                </div>
                <div class="box-body">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Golongan</th>
                                <th>Shift</th>
                                <th>Tgl Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->biodata->status }}</td>
                                    <td>{{ $user->biodata->golongan->name }}</td>
                                    <td>{{ $user->biodata->shift->id }}</td>
                                    <td>{{ $user->biodata->tgl_masuk }}</td>
                                    <td>
                                        <div class="btn-group-vertical">
                                            <button onclick="window.open('{{ url('data/user/cetak/'.$user->id) }}')" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Kartu</button>
                                            <form action="{{ url('data/user/delete') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </div>
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
                    <h3 class="box-title">Tambah</h3>
                </div>
                <div class="box-body">
                    <form action="{{ url('data/user/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pns">PNS</option>
                                <option value="nonpns">Non PNS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Masuk</label>
                            <input type="text" class="form-control" name="tgl_masuk" required placeholder="Format : yyyy-mm-dd">
                        </div>
                        <div class="form-group">
                            <label for="">Shift</label>
                            <select name="shift_id" id="shift_id" class="form-control" required>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->jam_masuk." - ".$shift->jam_keluar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Golongan</label>
                            <select name="golongan_id" id="golongan_id" class="form-control" required>
                                @foreach ($golongans as $golongan)
                                    <option value="{{ $golongan->id }}">{{ $golongan->id." - ".$golongan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Foto</label>
                            <input type="file" name="foto" id="foto" required>
                        </div>
                        <div class="form-group">
                            <label for="">NIP</label>
                            <input type="text" class="form-control" name="nip" placeholder="Opsional : wajib bagi PNS">
                        </div>
                        <div class="form-group">
                            <label for="">Gaji Pokok</label>
                            <input type="text" class="form-control" name="gapok" placeholder="Isi jika memilih status Non PNS">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection