<?php

namespace App\Http\Controllers;

use App\User;
use App\Shift;
use App\Biodata;
use App\Golongan;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['biodata' => function($query){
                    $query->with('shift', 'golongan');
                }])
                ->where('role_id', '!=', 1)
                ->get();
        
        $shifts = Shift::all();
        $golongans = Golongan::all();

        return view('pages.user.index', compact('users', 'shifts', 'golongans'));
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);
        $user->save();

        if ($request->hasFile('foto')) {
            $filename = $this->getFileName($request->foto);
            $request->foto->move(base_path('public/assets/images'), $filename);
        }else{
            $filename = 'placeholder.png';
        }

        $biodata = new Biodata;
        $biodata->fill([
            'user_id' => $user->id,
            'status' => $request->status,
            'tgl_masuk' => $request->tgl_masuk,
            'shift_id' => $request->shift_id,
            'golongan_id' => $request->golongan_id,
            'foto' => url('assets/images/'.$filename),
            'nip' => $request->nip,
            'gapok' => $request->gapok
        ]);
        $biodata->save();

        $request->session()->flash('msg', 'User berhasil dibuat');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id)->delete();
        $biodata = Biodata::where('user_id', $request->id)->delete();

        $request->session()->flash('msg', 'User dan biodata berhasil dihapus');
        return redirect()->back();
    }

    protected function getFileName($file)
    {
        return str_random(32) . '.' . $file->extension();
    }

    public function cetak($id=null)
    {
        $users = User::with(['biodata' => function ($query){
                    $query->with('shift', 'golongan');
                }])
                ->where('role_id', 2);
        if ($id != null){
            $users->where('id', $id);
        }
        $users = $users->get();

        return view('pages.user.print', compact('users'));
    }
}
