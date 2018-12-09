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
                    <h3 class="box-title">Data Jadwal</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Periode</th>
                                <th>Libur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->id }}</td>
                                    <td>{{ $jadwal->periode }}</td>
                                    <td>{{ $jadwal->libur }}</td>
                                    <td>
                                        <form action="{{ url('data/jadwal/delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $jadwal->id }}">
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
                    <h3 class="box-title">Tambah</h3>
                </div>
                <div class="box-body">
                    <form action="{{ url('data/jadwal/store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Periode</label>
                            <input type="text" class="form-control" name="periode" placeholder="Isi dengan format yyyy-mm-01" required>
                        </div>
                        <div class="form-group">
                            <label for="">Libur</label>
                            <input type="text" class="form-control" name="libur" placeholder="pisahkan tgl dengan koma cth: 12,16,14 termasuk minggu" required>
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