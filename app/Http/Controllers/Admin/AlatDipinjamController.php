<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class AlatDipinjamController extends Controller
{
    public function index()
    {
        $data['peminjam'] = Peminjam::get();

        return view('pages.admin.list-barang-dipinjam.index', $data);

    }
}
