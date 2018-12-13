<html>
    <head>
        <title>Kartu Karyawan</title>
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
                width: 200px;
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
                width: 100%;
                height: 200px;
                margin: 5px;
            }
        </style>
    </head>
    <body onload="window.print()">
        <div class="wrapper">
                @foreach ($users as $user)
                    <div class="box">
                        <div class="box-header">
                            <h3 style="text-align:center !important;">Kartu Karyawan</h3>
                        </div>
                        <div class="box-body">
                            <center>
                                {{-- <img src="{{ $user->biodata->foto }}" alt="{{ $user->name }}" style="width:150px;height:150px;"> --}}
                                {!! QrCode::size(130)->generate($user->email); !!}
                            </center>
                            <hr>
                            <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Nama</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Id Pegawai</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ strtoupper($user->biodata->status) }}</td>
                                </tr>
                                <tr>
                                    <td>Golongan</td>
                                    <td style="word-wrap: break-word;font-weight:unset !important;">{{ $user->biodata->golongan->name }}</td>
                                </tr>
                            </table>
                        </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </body>
</html>