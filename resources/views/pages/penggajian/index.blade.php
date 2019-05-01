@extends('site')

@section('content')
    @if (Session::has('msg'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-bell-o"></i> Info!</h4>
        {!! session('msg') !!}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">Penggajian</h3>
                </div>
                <div class="box-body">
                    <form action="{{ url('penggajian/proses') }}" method="GET">
                        <div class="form-group">
                            <label for="">Pilih periode</label>
                            <select name="periode" id="periode" class="form-control" required>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal->periode }}">{{ $jadwal->periode.' libur('.$jadwal->libur.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-check"></i> Pilih</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">Setting Lembur</h3>
                </div>
                <div class="box-body">
                    <form action="{{ url('penggajian/update_lembur') }}" method="post">
                        @csrf
                        <h4>PNS</h4>
                        <div class="form-group">
                            <label for="">Tambahan dalam RP (hanya angka)</label>
                            <input type="number" class="form-control" name="lembur_pns" value="{{ $lemburs[0]->nilai }}" required>
                        </div>
                        <h4>Non PNS</h4>
                        <div class="form-group">
                            <label for="">Tambahan dalam RP (hanya angka)</label>
                            <input type="number" class="form-control" name="lembur_non_pns" value="{{ $lemburs[1]->nilai }}" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">Setting Telat</h3>
                </div>
                <div class="box-body">
                    <form action="{{ url('penggajian/update_telat') }}" method="post">
                        @csrf
                        <h4>PNS</h4>
                        <div class="form-group">
                            <label for="">Potongan dalam RP (hanya angka)</label>
                            <input type="number" class="form-control" name="telat_pns" value="{{ $telats[0]->nilai }}" required>
                        </div>
                        <h4>Non PNS</h4>
                        <div class="form-group">
                            <label for="">Potongan dalam RP (hanya angka)</label>
                            <input type="number" class="form-control" name="telat_non_pns" value="{{ $telats[1]->nilai }}" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection