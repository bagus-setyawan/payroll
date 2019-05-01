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

        $request->session()->flash('msg', [
            'text' => 'Golongan berhasil dibuat',
            'class' => 'success'
        ]);
        return redirect()->back();
    }

    public function store_masa_kerja(Request $request)
    {
        $masa_kerja = new MasaKerja;
        $masa_kerja->fill($request->all());
        $masa_kerja->save();

        $request->session()->flash('msg', [
            'text' => 'Masa Kerja berhasil dibuat',
            'class' => 'success'
        ]);
        return redirect()->back();
    }

    public function delete_golongan(Request $request)
    {
        $golongan = Golongan::findOrFail($request->id);
        try {
            $golongan->delete();
        } catch (\Throwable $th) {
            $request->session()->flash('msg', [
                'text' => 'Golongan dan Masa kerja Gagal dihapus, masih ada user yang terkait',
                'class' => 'danger'
            ]);
            return redirect()->back();
        }
        
        $masa_kerja = MasaKerja::find($request->id);

        if ($masa_kerja) {
            $masa_kerja->delete();
        }

        $request->session()->flash('msg', [
            'text' => 'Golongan dan Masa kerja berhasil dihapus',
            'class' => 'success'
        ]);
        return redirect()->back();
    }
    
    public function delete_masa_kerja(Request $request)
    {
        $masa_kerja = MasaKerja::findOrFail($request->id)->delete();

        $request->session()->flash('msg', [
            'text' => 'Masa kerja berhasil dihapus',
            'class' => 'success'
        ]);
        return redirect()->back();
    }

    public function show(Request $request)
    {
        $golongan = Golongan::findOrFail($request->id);

        return response()->json($golongan);
    }

    public function update(Request $request)
    {
        $golongan = Golongan::findOrFail($request->id);

        $golongan->name = $request->name;
        $golongan->description = $request->description;

        $golongan->save();

        $request->session()->flash('msg', [
            'text' => 'Golongan berhasil diupdate',
            'class' => 'success'
        ]);
        return redirect()->back();
    }
}
