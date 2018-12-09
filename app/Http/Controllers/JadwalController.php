<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();

        return view('pages.jadwal.index', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $jadwal = new Jadwal;
        $jadwal->fill($request->all());
        $jadwal->save();

        $request->session()->flash('msg', 'Jadwal berhasil dibuat');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $jadwal = Jadwal::findOrFail($request->id)->delete();

        $request->session()->flash('msg', 'Jadwal berhasil dihapus');
        return redirect()->back();
    }
}
