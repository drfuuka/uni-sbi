<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $data['total_alat'] = Barang::count();
        $data['alat_tersedia'] = Barang::where('status', 'Tersedia')->count();
        $data['sedang_dipinjam'] = Barang::where('status', 'Dipinjam')->count();
        $data['dalam_inspeksi'] = Barang::where('status', 'Dalam Inspeksi')->count();
        return view('pages.admin.index', $data);
    }
}
