<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('pages.penggajian.index', compact('jadwals'));
    }
}
