<?php

namespace App\Http\Controllers;

use App\User;
use App\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('pages.penggajian.index', compact('jadwals'));
    }

    public function proses(Request $request)
    {
        $periode = Carbon::parse($request->input('periode'));

        $gajis = $this->_getSalary($periode->year, $periode->month);
        
        for ($i=0; $i < count($gajis); $i++) { 
            $gajis[$i]->potongan = $gajis[$i]->lama_telat*$gajis[$i]->biaya_telat;
            $gajis[$i]->tambahan = $gajis[$i]->lama_lembur*$gajis[$i]->biaya_lembur;
            $gajis[$i]->lama_kerja = Carbon::parse($gajis[$i]->tgl_masuk)->age;
            if ($gajis[$i]->status === 'pns') {
                $gajis[$i]->gapok = DB::table('masa_kerjas')->select('gapok')
                                        ->where('golongan_id', $gajis[$i]->gol_id)
                                        ->where('lama', Carbon::parse($gajis[$i]->tgl_masuk)->age)
                                        ->first()->gapok;
            }
            $gajis[$i]->total = $gajis[$i]->gapok+$gajis[$i]->tambahan-$gajis[$i]->potongan;
        }
        setlocale(LC_TIME, 'ID');
        $period = $periode->localeMonth." ".$periode->year;
        return view('pages.presensi.proses', compact('gajis', 'period'));
    }

    public function print(Request $request)
    {
        $periode = Carbon::parse($request->input('periode'));

        $gajis = $this->_getSalary($periode->year, $periode->month);
        
        for ($i=0; $i < count($gajis); $i++) { 
            $gajis[$i]->potongan = $gajis[$i]->lama_telat*$gajis[$i]->biaya_telat;
            $gajis[$i]->tambahan = $gajis[$i]->lama_lembur*$gajis[$i]->biaya_lembur;
            $gajis[$i]->lama_kerja = Carbon::parse($gajis[$i]->tgl_masuk)->age;
            if ($gajis[$i]->status === 'pns') {
                $gajis[$i]->gapok = DB::table('masa_kerjas')->select('gapok')
                                        ->where('golongan_id', $gajis[$i]->gol_id)
                                        ->where('lama', Carbon::parse($gajis[$i]->tgl_masuk)->age)
                                        ->first()->gapok;
            }
            $gajis[$i]->total = $gajis[$i]->gapok+$gajis[$i]->tambahan-$gajis[$i]->potongan;
        }
        setlocale(LC_TIME, 'ID');
        $period = $periode->localeMonth." ".$periode->year;
        return view('pages.penggajian.print', compact('gajis', 'period'));
    }
    
    private function _getSalary($year, $month)
    {
        return DB::table('users')
        ->select(DB::raw('0 AS total, 0 AS potongan, 0 AS tambahan, 0 AS lama_kerja'))
        ->select('users.id', 'users.name', 'users.email', 'biodatas.tgl_masuk', 
                    'biodatas.foto', 'biodatas.status', 'biodatas.gapok AS gapok', 
                    'golongans.name AS gol', 'golongans.id AS gol_id', 'lemburs.nilai AS biaya_lembur', 
                    'telats.nilai AS biaya_telat')
        ->selectRaw('COALESCE((SELECT SUM(lama_lembur) FROM absensis WHERE EXTRACT(year from absen_masuk) = ? AND EXTRACT(month from absen_masuk) = ? AND user_id = users.id),0) AS lama_lembur', 
                    [$year, $month])
        ->selectRaw('COALESCE((SELECT SUM(lama_telat) FROM absensis WHERE EXTRACT(year from absen_masuk) = ? AND EXTRACT(month from absen_masuk) = ? AND user_id = users.id),0) AS lama_telat', 
                    [$year, $month])
        ->join('biodatas', 'biodatas.user_id', '=', 'users.id')
        ->join('lemburs', 'lemburs.status', '=', 'biodatas.status')
        ->join('telats', 'telats.status', '=', 'biodatas.status')
        ->join('golongans', 'golongans.id', '=', 'biodatas.golongan_id')
        ->get();
    }
}
