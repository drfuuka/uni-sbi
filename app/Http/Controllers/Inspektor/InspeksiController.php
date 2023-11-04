<?php

namespace App\Http\Controllers\Inspektor;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Inspeksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InspeksiController extends Controller
{
    public function index()
    {
        $data['inspeksi'] = Inspeksi::get()->map(function($item) {
            return [
                ...$item->toArray(),
                'nama_inspektor' => $item->user->name,
                'nama_barang'    => $item->barang->nama_barang
            ];
        });

        return view('pages.inspektor.inspeksi.index', $data);
    }

    public function create()
    {
        $data['barang'] = Barang::select('nama_barang', 'kode_barang')->get();
        return view('pages.inspektor.inspeksi.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'                  => ['exists:barang,id'],
            'nomor_id'                   => ['required'],
            'inspektor_sbi_area'         => ['required'],
            'kepemilikan_alat'           => ['required'],
            'periode_inspeksi'           => ['required'],
            'nomor_register'             => ['required'],
            'email_eht'                  => ['nullable', 'email'],
            'nama_perusahaan_kontraktor' => ['nullable', 'string'],
            'syarat_inspeksi'            => ['required']
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if($barang->status === 'Dipinjam') {
            return redirect()->route('inspektor.inspeksi.create')->with('error', 'Alat sedang dalam peminjaman');
        } else if($barang->status === 'Dalam Inspeksi') {
            return redirect()->route('inspektor.inspeksi.create')->with('error', 'Alat sedang dalam inspeksi');
        }

        $barang->update([
            'status' => 'Dalam Inspeksi'
        ]);

        Inspeksi::create([
            'kode_inspeksi'              => generate_number('inspeksi', 'kode_inspeksi', 3, 'INS'),
            'inspektor_id'               => Auth::user()->id,
            'nomor_id'                   => $request->nomor_id,
            'inspektor_sbi_area'         => $request->inspektor_sbi_area,
            'kepemilikan_alat'           => $request->kepemilikan_alat,
            'periode_inspeksi'           => $request->periode_inspeksi,
            'nomor_register'             => $request->nomor_register,
            'email_eht'                  => $request->email_eht,
            'nama_perusahaan_kontraktor' => $request->nama_perusahaan_kontraktor,
            'syarat_inspeksi'            => $request->syarat_inspeksi,
            'barang_id'                  => $barang->id,
            'kondisi'                    => $barang->kondisi
        ]);

        return redirect()->route('inspektor.inspeksi.index');
    }

    public function edit($id)
    {
        $data['inspeksi'] = Inspeksi::find($id);

        return view('pages.inspektor.inspeksi.edit', $data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $request->validate([
            'barang_id'                  => ['exists:barang,id'],
            'nomor_id'                   => ['required'],
            'inspektor_sbi_area'         => ['required'],
            'kepemilikan_alat'           => ['required'],
            'periode_inspeksi'           => ['required'],
            'nomor_register'             => ['required'],
            'email_eht'                  => ['nullable', 'email'],
            'nama_perusahaan_kontraktor' => ['nullable', 'string'],
            'syarat_inspeksi'            => ['required']
        ]);

        $inspeksi = Inspeksi::findOrFail($id);

        $inspeksi->nomor_id                   = $request->nomor_id;
        $inspeksi->inspektor_sbi_area         = $request->inspektor_sbi_area;
        $inspeksi->kepemilikan_alat           = $request->kepemilikan_alat;
        $inspeksi->periode_inspeksi           = $request->periode_inspeksi;
        $inspeksi->nomor_register             = $request->nomor_register;
        $inspeksi->email_eht                  = $request->email_eht;
        $inspeksi->nama_perusahaan_kontraktor = $request->nama_perusahaan_kontraktor;
        $inspeksi->syarat_inspeksi            = $request->syarat_inspeksi;
        $inspeksi->kondisi                    = $request->kondisi;
        $inspeksi->selesai                    = $request->selesai === 'Ya' ? true : false;

        $inspeksi->save();

        $inspeksi->barang->update([
            'kondisi'  => $request->kondisi,
        ]);

        if($request->selesai) {
            $inspeksi->barang->update([
                'status'  => 'Tersedia',
            ]);
        }

        DB::commit();
        return redirect()->route('inspektor.inspeksi.index');
    
    }

    public function destroy($id)
    {   
        Inspeksi::destroy($id);

        return redirect()->route('inspektor.inspeksi.index');
    }

    public function scan($kode) {
        $data = Barang::where('kode_barang', $kode)->first();
        return response($data);
    }
}
