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
                    <h3 class="box-title">Data Golongan</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($golongans as $golongan)
                                <tr>
                                    <td>{{ $golongan->id }}</td>
                                    <td>{{ $golongan->name }}</td>
                                    <td>{{ $golongan->description }}</td>
                                    <td>
                                        <form action="{{ url('data/golongan/delete_golongan') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $golongan->id }}">
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
                    <form action="{{ url('data/golongan/store_golongan') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Isi dengan format romawi:alphabet cth : IVA" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Penjelasan golongan" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-md"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">Data Masa Kerja</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Golongan</th>
                                <th>Lama Kerja</th>
                                <th>Gaji Pokok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masa_kerjas as $masa_kerja)
                                <tr>
                                    <td>{{ $masa_kerja->id }}</td>
                                    <td>{{ $masa_kerja->golongan->name }}</td>
                                    <td>{{ $masa_kerja->lama }}</td>
                                    <td>{{ $masa_kerja->gapok }}</td>
                                    <td>
                                        <form action="{{ url('data/golongan/delete_masa_kerja') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $masa_kerja->id }}">
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
                    <form action="{{ url('data/golongan/store_masa_kerja') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Golongan</label>
                            <select name="golongan_id" id="golongan_id" class="form-control">
                                @foreach ($golongans as $golongan)
                                    <option value="{{ $golongan->id }}">{{ $golongan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Lama kerja</label>
                            <input type="text" class="form-control" name="lama" placeholder="Lama kerja dalam tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="">Gaji Pokok</label>
                            <input type="text" class="form-control" name="gapok" placeholder="Gapok tulis angka" required>
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