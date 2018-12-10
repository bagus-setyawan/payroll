<html>
    <head>
        <title>Slip gaji</title>
        <style>
            body{
                margin: 0;
                padding: 10px;
            }
            .wrapper{
                width: 100%;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 8pt;
            }
            .box{
                display: inline-block;
                width: 300px;
                margin: 5px;
                height: auto;
                border: 1px #000 dashed;
                border-radius: 8px;
            }
            .box-header{
                display: block;
                position: relative;
                background-color: blue;
                height: 20px;
                padding: 10px;
            }
            .box-header h3{
                font-size: 18px;
                margin: 0;
                line-height: 1;
                color: #fff;
            }
            .table{
                width: 100%;
                padding: 5px;
                table-layout: fixed;
            }
            .table td{
                word-wrap: break-word;
            }
            img{
                width: auto;
                height: 200px;
                margin: 5px;
            }
        </style>
    </head>
    <body onload="window.print()">
        <div class="wrapper">
                @foreach ($gajis as $gaji)
                    <div class="box">
                        <div class="box-header">
                            <h3 style="text-align:center !important;">Slip gaji</h3>
                        </div>
                        <div class="box-body">
                            <center>
                                <img src="{{ $gaji->foto }}" alt="{{ $gaji->name }}">
                            </center>
                            <hr>
                            <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Periode</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $period }}</td>
                                </tr>
                                <tr>
                                    <td>Id Pegawai</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $gaji->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pegawai</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $gaji->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $gaji->email }}</td>
                                </tr>
                                <tr>
                                    <td>Lama Kerja</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $gaji->lama_kerja }} tahun</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ strtoupper($gaji->status) }}</td>
                                </tr>
                                <tr>
                                    <td>Lama Lembur</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $gaji->lama_lembur }} jam</td>
                                </tr>
                                <tr>
                                    <td>Lama Telat</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $gaji->lama_telat }} jam</td>
                                </tr>
                                <tr>
                                    <td>Gaji Pokok</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">Rp. {{ number_format($gaji->gapok) }}</td>
                                </tr>
                                <tr>
                                    <td>Tambahan (lembur)</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">Rp. {{ number_format($gaji->tambahan) }}</td>
                                </tr>
                                <tr>
                                    <td>Potongan (terlambat)</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">Rp. {{ number_format($gaji->potongan) }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">Rp. {{ number_format($gaji->total) }}</td>
                                </tr>
                            </table>
                        </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <script>
            
        </script>
    </body>
</html>