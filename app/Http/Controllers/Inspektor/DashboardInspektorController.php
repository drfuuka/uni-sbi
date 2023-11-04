<?php

namespace App\Http\Controllers\Inspektor;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Inspeksi;
use Illuminate\Http\Request;

class DashboardInspektorController extends Controller
{
    public function index()
    {
        $data['total_alat'] = Barang::count();
        $data['dalam_inspeksi'] = Inspeksi::where('selesai', false)->count();
        $data['inspeksi_selesai'] = Inspeksi::where('selesai', true)->count();

        return view('pages.inspektor.index', $data);
    }
}
