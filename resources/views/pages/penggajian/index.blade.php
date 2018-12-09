@extends('site')

@section('content')
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
@endsection