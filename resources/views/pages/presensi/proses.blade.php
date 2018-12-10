@extends('site')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header">
                    <h3 class="box-title">Daftar gaji karyawan</h3>
                    <a class="btn btn-default btn-sm pull-right" style="background-color:#696969;" href="{{ url('penggajian/print?periode='.request()->query('periode')) }}" target="_blank"><i class="fa fa-print"></i> Print</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Periode</th>
                            <th>Id Pegawai</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Lama kerja</th>
                            <th>Status</th>
                            <th>Lama Lembur</th>
                            <th>Lama telat</th>
                            <th>Gaji pokok</th>
                            <th>Tambahan</th>
                            <th>Potongan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gajis as $gaji)
                            <tr>
                                <td><img src="{{ $gaji->foto }}" alt="{{ $gaji->name }}" class="img-responsive"></td>
                                <td>{{ $period }}</td>
                                <td>{{ $gaji->id }}</td>
                                <td>{{ $gaji->name }}</td>
                                <td>{{ $gaji->email }}</td>
                                <td>{{ $gaji->lama_kerja }} tahun</td>
                                <td>{{ strtoupper($gaji->status) }}</td>
                                <td>{{ $gaji->lama_lembur }} jam</td>
                                <td>{{ $gaji->lama_telat }} jam</td>
                                <td>{{ number_format($gaji->gapok) }}</td>
                                <td>{{ number_format($gaji->tambahan) }}</td>
                                <td>{{ number_format($gaji->potongan) }}</td>
                                <td>{{ number_format($gaji->total) }}</td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection