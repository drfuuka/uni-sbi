<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    public function index()
    {
        return view('pages.peminjam.index');
    }

    public function scan($kode) {
        $data = Barang::where('kode_barang', $kode)->first();
        return response($data);
    }

    public function pinjam(Request $request)
    {
        DB::beginTransaction();

        $barang = Barang::find($request->barang_id);

        if(!$barang) {
            return redirect()->route('peminjam.index')->with('error', 'Alat tidak ditemukan');
        }
        
        
        if($barang->status === 'Dipinjam') {
            Peminjam::where('barang_id', $barang->id)->update([
                'status' => 'Selesai'
            ]);

            $barang->update([
                'status' => 'Tersedia'
            ]);

            DB::commit();
            return redirect()->route('peminjam.index')->with('message', 'Alat berhasil dikembalikan');

        } else if($barang->status === 'Dalam Inspeksi') {
            return redirect()->route('peminjam.index')->with('error', 'Alat sedang dalam inspeksi');

        } else {
            $request->validate([
                'barang_id'     => ['exists:barang,id'],
                'nama_peminjam' => ['string'],
                'jabatan'       => ['string'],
                'department'    => ['string'],
            ]);

            Peminjam::create([
                'nama_peminjam' => $request->nama_peminjam,
                'jabatan'       => $request->jabatan,
                'department'    => $request->department,
                'barang_id'     => $request->barang_id,
                'status'        => 'Berjalan'
            ]);
    
            $barang->update([
                'status' => 'Dipinjam'
            ]);

            DB::commit();
            return redirect()->route('peminjam.index')->with('message', 'Alat berhasil dipinjam');
        }
        
    }
}
