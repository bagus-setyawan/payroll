<?php

namespace App\Http\Controllers;

use App\Golongan;
use App\MasaKerja;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        $golongans = Golongan::all();
        $masa_kerjas = MasaKerja::with('golongan')->get();

        return view('pages.golongan.index', compact('golongans', 'masa_kerjas'));
    }

    public function store_golongan(Request $request)
    {
        $golongan = new Golongan;
        $golongan->fill($request->all());
        $golongan->save();

        $request->session()->flash('msg', 'Golongan berhasil dibuat');
        return redirect()->back();
    }

    public function store_masa_kerja(Request $request)
    {
        $masa_kerja = new MasaKerja;
        $masa_kerja->fill($request->all());
        $masa_kerja->save();

        $request->session()->flash('msg', 'Masa Kerja berhasil dibuat');
        return redirect()->back();
    }

    public function delete_golongan(Request $request)
    {
        $golongan = Golongan::findOrFail($request->id)->delete();
        $masa_kerja = MasaKerja::find($request->id)->delete();

        $request->session()->flash('msg', 'Golongan dan Masa kerja berhasil dihapus');
        return redirect()->back();
    }
    
    public function delete_masa_kerja(Request $request)
    {
        $masa_kerja = MasaKerja::findOrFail($request->id)->delete();

        $request->session()->flash('msg', 'Masa kerja berhasil dihapus');
        return redirect()->back();
    }
}
