<?php

namespace App\Http\Controllers;

use App\User;
use App\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function check(Request $request)
    {
        $email = $request->input('email');

        $user = User::with('biodata')->where('email', $email)->first();

        if (!empty($user)) {
            $date_now = date("Y-m-d");
            $time_now = date("H:i:s");

            $query = DB::table('jadwals')
                        ->whereYear('periode', date('Y'))
                        ->whereMonth('periode', date('m'))
                        ->select('libur')
                        ->first();
            $libur = explode(',', $query->libur);
            if (in_array(date('d'), $libur)) {
                return response()->json([
                    'error' => true,
                    'msg' => "Hari ini libur guys ! Rajin amat."
                ]);
            }
            
            $shift = DB::table('biodatas')
                        ->join('shifts', 'biodatas.shift_id', '=', 'shifts.id')
                        ->where('biodatas.user_id', $user->id)
                        ->select('jam_masuk', 'jam_keluar')
                        ->first();
            $jam_sekarang = Carbon::now();
            $jam_masuk = Carbon::parse($shift->jam_masuk);
            $jam_keluar = Carbon::parse($shift->jam_keluar);

            //jika tidak satu jam sebelum, satu jam sebelum dan satu jam sesudah, tidak diantara shift
            if ($jam_sekarang->diffInHours($jam_masuk, false) != -1 && $jam_sekarang->diffInHours($jam_masuk, false) != 0 && !$jam_sekarang->between($jam_masuk, $jam_keluar)) {
                return response()->json([
                    'error' => true,
                    'msg' => "Belum waktunya absen yah..."
                ]);
            }

            if (!$this->sudahAbsen($date_now, $user->id)) {
                $data = [
                    'user_id' => $user->id,
                    'absen_masuk' => $jam_sekarang->toDateTimeString(),
                ];
                if ($jam_masuk->diffInMinutes($jam_sekarang, false) > 0) {
                    $data['lama_telat'] = ceil($jam_masuk->diffInMinutes($jam_sekarang, false)/60);
                }
                Absensi::create($data);

                return response()->json([
                    'error' => false,
                    'foto' => $user->biodata->foto,
                    'name' => $user->name,
                    'id' => $user->id,
                    'presensi' => isset($data['lama_telat']) ? 'Terlambat':'Tepat waktu',
                    'terlambat' => isset($data['lama_telat']) ? $data['lama_telat'].' jam':'0 jam',
                    'lembur' => '-',
                    'msg' => "Absen masuk berhasil"
                ]);
            }else {
                $data = [
                    'absen_pulang' => $jam_sekarang->toDateTimeString()
                ];
                if ($jam_keluar->diffInMinutes($jam_sekarang, false) > 0) {
                    echo($jam_keluar->diffInHours($jam_sekarang, false));
                    $data['lama_lembur'] = ceil($jam_keluar->diffInMinutes($jam_sekarang, false)/60);
                }
                Absensi::where('user_id', $user->id)
                            ->update($data);
                
                return response()->json([
                    'error' => false,
                    'foto' => $user->biodata->foto,
                    'name' => $user->name,
                    'id' => $user->id,
                    'presensi' => isset($data['lama_lembur']) ? 'Lembur semangat !!':'Terima kasih',
                    'lembur' => isset($data['lama_lembur']) ? $data['lama_lembur'].' jam':'0 jam',
                    'terlambat' => '-',
                    'msg' => "Absen pulang berhasil"
                ]);
            }
        } else {
            $response = [
                'error' => true,
                'msg' => "Pegawai tidak terdaftar"
            ];
            return response()->json($response);
        }
    }

    public function sudahAbsen($date, $user_id)
    {
        return DB::table('absensis')
                ->whereDate('absen_masuk', $date)
                ->where('user_id', $user_id)
                ->exists();
    }
}
